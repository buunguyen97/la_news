<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
use App\Slide;
use App\TinTuc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    function __construct()
    {
        $theloai = TheLoai::all();
        $slide = Slide::all();
        if (Auth::check()) {
            View::share('nguoidung', Auth::user());
        }
        view()->share('theloai',$theloai);
        view()->share('slide',$slide);

    }

    function trangchu (){

        return view('pages.trangchu');
    }
    function lienhe(){

        return view('pages.lienhe');
    }
    function loaitin($id){
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }
    function tintuc($id){
        $tintuc =TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=> $tinnoibat,'tinlienquan'=> $tinlienquan]);
    }
    function getDangNhap(){
        return view('pages.dangnhap');
    }
    function postDangNhap(Request $request){
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required|min:3|max:32'
        ],[
            'email.required' => 'Bạn chưa nhập email',
            'password.required' => 'Bạn chưa nhập password',
            'password.min' => 'Mật khẩu lớn hơn 3 kí tự',
            'password.max' => 'Mật khẩu it hơn 32 kí tự',
        ]);

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('trangchu');

        }
        else{
            return redirect('dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
    }
    function getDangXuat(){
        Auth::logout();
        return redirect('trangchu');
    }
    function getNguoiDung(){

        return view('pages.nguoidung');
    }
    function postNguoiDung(Request $request){
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required',
        ],
            [
                'name.required' => 'Bạn chưa nhập tên',


            ]);
        $user->name =$request->name;
        if($request->checkpassword == "on"){
            $this->validate($request, [
                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password',
            ],
                [
                    'password.required' => 'Bạn chưa nhập password',
                    'password.min' => 'mật khẩu nhiều hơn 3 ký tự',
                    'password.max' => 'mật khẩu ít hơn 32 ký tự',
                    'passwordAgain.required' => 'Bạn chưa nhập lại password',
                    'passwordAgain.same' => 'Mật khẩu nhập lại chưa đúng',


                ]);
        }
        $password =bcrypt($request->password);
        $user->password =$password;
        $user->save();
        return redirect('nguoidung')->with('thongbao','Sửa Thành công');
    }

    function getDangKy(){
        return view('pages.dangky');
    }

    function postDangKy(Request $request){
        $user = new User();
        $this->validate($request, [
            'name' => 'required',
        ],
            [
                'name.required' => 'Bạn chưa nhập tên',


            ]);
        $user->name =$request->name;
        if($request->checkpassword == "on"){
            $this->validate($request, [
                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password',
            ],
                [
                    'password.required' => 'Bạn chưa nhập password',
                    'password.min' => 'mật khẩu nhiều hơn 3 ký tự',
                    'password.max' => 'mật khẩu ít hơn 32 ký tự',
                    'passwordAgain.required' => 'Bạn chưa nhập lại password',
                    'passwordAgain.same' => 'Mật khẩu nhập lại chưa đúng',


                ]);
        }
        $password =bcrypt($request->password);
        $user->password =$password;
        $user->email = $request->email;
        $user->save();
        return redirect('dangky')->with('thongbao','Đăng ký Thành công');
    }


    function timkiem(Request $request){
        $tukhoa = $request->tukhoa;
        $tintuc =TinTuc::where('TieuDe','like',"%$tukhoa%")->orwhere('TomTat','like',"%$tukhoa%")->orwhere('NoiDung','like',"%$tukhoa%")->take(30)->paginate(5);
        return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }
}

<?php

namespace App\Http\Controllers;

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
            'password' => 'required|min:6|max:32'
        ],[
            'email.required' => 'Bạn chưa nhập email',
            'password.required' => 'Bạn chưa nhập password',
            'password.min' => 'Mật khẩu lớn hơn 6 kí tự',
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
}

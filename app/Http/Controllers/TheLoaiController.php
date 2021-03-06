<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class TheLoaiController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//
//    }

    //
    public function getDanhSach(){
//        echo "<pre>"; print_r(Auth::user()); exit;
        $theloai = TheLoai::all();

        return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }
    public function getThem(){
        return view('admin.theloai.them');
    }
    public function getSua($id){
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id){
        $theloai= TheLoai::find($id);
        $this->validate($request,
            [
                'Ten'=>'required|min:3|max:100'
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên thể loại',
                'Ten.min'=>'Ít nhất 3 kí tự',
                'Ten.max'=>'Độ dài quá dài,ít hơn 100 kí tự',
            ]);
        $theloai ->Ten =$request->Ten;
        $theloai ->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/danhsach')->with('thongbao','Sửa thành công');
    }
    public function postThem(Request $request){
        $this->validate($request,
            [
                'Ten'=>'required|min:3|max:100'
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên thể loại',
                'Ten.min'=>'Ít nhất 3 kí tự',
                'Ten.max'=>'Độ dài quá dài,ít hơn 100 kí tự',
            ]);
        $theloai = new TheLoai();
        $theloai->Ten=$request->Ten;
        $theloai->TenKhongDau=changeTitle($request->Ten);
        $theloai->save();
       return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');
    }

    public function getXoa($id){
        $theloai=TheLoai::find($id);
        $theloai->delete();

        return redirect('admin/theloai/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }
}

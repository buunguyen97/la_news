<?php

namespace App\Http\Controllers;

use App\TheLoai;
use Illuminate\Http\Request;
use App\LoaiTin;

class LoaiTinController extends Controller
{
    public function getDanhSach(){
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.danhsach',['theloai'=>$loaitin]);
    }

    public function getThem(){
        $theloai = TheLoai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }
    public function postThem(Request $request){
        $this->validate($request,
            [
                'Ten'=>'required|min:3|max:100'
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên loại tin',
                'Ten.min'=>'Ít nhất 3 kí tự',
                'Ten.max'=>'Độ dài quá dài,ít hơn 100 kí tự',
            ]);
        $loaitin = new  LoaiTin();
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->idTheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','Thêm thành công');

    }
    public  function getSua($id){
        $loaitin = LoaiTin::find($id);
        $theloai = TheLoai::all();
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id){
        $loaitin = LoaiTin::find($id);
        $this->validate($request,
            [
                'Ten'=>'required|min:3|max:100'
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên thể loại',
                'Ten.min'=>'Ít nhất 3 kí tự',
                'Ten.max'=>'Độ dài quá dài,ít hơn 100 kí tự',
            ]);
        $loaitin->Ten =$request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/danhsach')->with('thongbao','Sửa thành công');
    }
    public function getXoa($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao','xóa thành công');
    }
}

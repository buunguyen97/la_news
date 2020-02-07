<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use Illuminate\Support\Str;
use App\Comment;

class TinTucController extends Controller
{
    //
    public function getDanhSach()
    {
        $tintuc = TinTuc::orderBy('id', 'DESC')->get();
        return view('admin.tintuc.danhsach', ['tintuc' => $tintuc]);
    }

    public function getThem()
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.them', ['theloai' => $theloai, 'loaitin' => $loaitin]);
    }

    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'TieuDe' => 'required|min:10|max:1000',
                'LoaiTin' => 'required',
                'TomTat' => 'required',
                'NoiDung' => 'required',
            ],
            [
                'LoaiTin.required' => 'Bạn chưa chọn loại tin',
                'TieuDe.required' => 'Bạn chưa Nhập tiêu đề',
                'NoiDung.required' => 'Bạn chưa Nhập nội dung',
                'TomTat.required' => 'Bạn chưa Nhập tóm tắt',
                'TieuDe.min' => 'Ít nhất 10 kí tự',
                'TieuDe.max' => 'Độ dài quá dài,ít hơn 1000 kí tự',
            ]);
        $tintuc = new TinTuc();
        $tintuc ->TieuDe = $request->TieuDe;
        $tintuc ->TieuDeKhongDau =changeTitle( $request->TieuDe);
        $tintuc ->TomTat = $request->TomTat;
        $tintuc ->NoiDung = $request->NoiDung;
        $tintuc ->idLoaiTin = $request->LoaiTin;
        $tintuc ->NoiBat = $request->NoiBat;
        $tintuc ->SoLuotXem = 0;
        if ($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $Hinh= Str::random(4)."_".$name;
            $file ->move("upload/tintuc",$Hinh);
            $tintuc->Hinh=$Hinh;

        }
        else{
            $tintuc->Hinh = "";
        }

        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao','Thêm Thành công');
    }
    public function postSua(Request $request,$id){
        $tintuc =TinTuc::find($id);
        $this->validate($request,
            [
                'TieuDe' => 'required|min:10|max:1000',
                'LoaiTin' => 'required',
                'TomTat' => 'required',
                'NoiDung' => 'required',
            ],
            [
                'LoaiTin.required' => 'Bạn chưa chọn loại tin',
                'TieuDe.required' => 'Bạn chưa Nhập tiêu đề',
                'NoiDung.required' => 'Bạn chưa Nhập nội dung',
                'TomTat.required' => 'Bạn chưa Nhập tóm tắt',
                'TieuDe.min' => 'Ít nhất 10 kí tự',
                'TieuDe.max' => 'Độ dài quá dài,ít hơn 1000 kí tự',
            ]);
        $tintuc ->TieuDe = $request->TieuDe;
        $tintuc ->TieuDeKhongDau =changeTitle( $request->TieuDe);
        $tintuc ->TomTat = $request->TomTat;
        $tintuc ->NoiDung = $request->NoiDung;
        $tintuc ->idLoaiTin = $request->LoaiTin;
        $tintuc ->NoiBat = $request->NoiBat;
        if ($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $Hinh= Str::random(4)."_".$name;
            $file ->move("upload/tintuc",$Hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh=$Hinh;

        }


        $tintuc->save();
        return redirect('admin/tintuc/danhsach')->with('thongbao','Sửa Thành công');
    }
    public function getSua($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc =TinTuc::find($id);
        return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function getXoa($id){
        $tintuc = TinTuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao','Xóa Thành Công');
    }
}

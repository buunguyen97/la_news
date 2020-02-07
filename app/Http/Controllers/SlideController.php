<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use Illuminate\Support\Str;

class SlideController extends Controller
{
    public function getDanhSach()
    {
        $slide = Slide::all();
        return view('admin.slide.danhsach', ['slide' => $slide]);
    }

    public function getThem()
    {
        return view('admin.slide.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request, [
            'Ten' => 'required',
            'NoiDung' => 'required',
            'link' => 'required',
        ],
        [
            'Ten.required' => 'Bạn chưa nhập tên',
            'NoiDung.required' => 'Bạn chưa Nhập nội dung',
            'link.required' => 'Bạn chưa Nhập link',

        ]);
        $slide = new Slide();
        $slide->Ten =$request->Ten;
        $slide->NoiDung =$request->NoiDung;
        if ($request->has('link')){
            $slide->link =$request->link;
        }
        if ($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $Hinh= Str::random(4)."_".$name;
            $file ->move("upload/slide/",$Hinh);
            $slide->Hinh=$Hinh;

        }
        else{
            $slide->Hinh = "";

        }
        $slide->save();
        return redirect('admin/slide/danhsach')->with('thongbao','Thêm slide thành công');

    }
    public function getXoa($id){
        $slide = Slide::find($id);
        $slide ->delete();
        return redirect('admin/slide/danhsach')->with('thongbao','Xóa thành công !!!');
    }
    public function getSua($id){
        $slide = Slide::find($id);
        return view('admin.slide.sua',['slide'=>$slide]);
    }
    public function postSua(Request $request,$id){
        $slide = Slide::find($id);
        $this->validate($request, [
            'Ten' => 'required',
            'NoiDung' => 'required',
            'link' => 'required',
        ],
            [
                'Ten.required' => 'Bạn chưa nhập tên',
                'NoiDung.required' => 'Bạn chưa Nhập nội dung',
                'link.required' => 'Bạn chưa Nhập link',

            ]);
        $slide->Ten =$request->Ten;
        $slide->NoiDung =$request->NoiDung;
        if ($request->has('link')){
            $slide->link =$request->link;
        }
        if ($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $Hinh= Str::random(4)."_".$name;
            $file ->move("upload/slide/",$Hinh);
            unlink('upload/slide'.$slide->Hinh);
            $slide->Hinh=$Hinh;

        }
        $slide->save();
        return redirect('admin/slide/danhsach')->with('thongbao','Sửa slide thành công');
    }
}

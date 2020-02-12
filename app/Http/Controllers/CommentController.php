<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\TheLoai;
use App\LoaiTin;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function getXoa($idTinTuc,$id){
        $comment = Comment::find($id);
        $comment->delete();

        return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbao','xóa thành công');
    }
    public function postComment(Request $request,$id){
        $idTinTuc = $id;
        $tintuc =TinTuc::find($id);
        $comment = new Comment();
        $comment ->idTinTuc =$idTinTuc;
        $comment ->idUser = Auth::user()->id;
        $comment->NoiDung = $request->NoiDung;
        $comment ->save();
        return redirect("tintuc/$id/".$tintuc->TieuDeKhongDau.".html")->with('thongbao','Bình Luận thành công');
    }
}

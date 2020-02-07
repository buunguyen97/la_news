<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\TheLoai;
use App\LoaiTin;
use App\Comment;
use App\User;

class CommentController extends Controller
{
    public function getXoa($idTinTuc,$id){
        $comment = Comment::find($id);
        $comment->delete();

        return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbao','xóa thành công');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function getDanhSach(){
        $user = User::all();
        return view('admin.user.danhsach',['user' => $user]);
    }
    public function getThem(){
        return view('admin.user.them');
    }
    public function postThem(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
        ],
            [
                'name.required' => 'Bạn chưa nhập tên',
                'email.required' => 'Bạn chưa Nhập email',
                'password.required' => 'Bạn chưa Nhập password',
                'password.min' => 'Password nhiều hơn 6 kí tự',

            ]);

        $user = new User();
        $user->name =$request->name;
        $user->email =$request->email;
        $password =bcrypt($request->password);
        $user->password =$password;
        $user->quyen =$request->quyen;
        $user->save();
        return redirect('admin/user/danhsach')->with('thongbao','Thêm Thành công');

    }
    public function getSua($id){
        $user = User::find($id);
        return view('admin.user.sua',['user'=>$user]);

    }
    public function postSua(Request $request,$id){
        $user = User::find($id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
        ],
            [
                'name.required' => 'Bạn chưa nhập tên',
                'email.required' => 'Bạn chưa Nhập email',
                'password.required' => 'Bạn chưa Nhập password',
                'password.min' => 'Password nhiều hơn 6 kí tự',

            ]);
        $user->name =$request->name;
        $user->email =$request->email;
        $password =bcrypt($request->password);
        $user->password =$password;
        $user->quyen =$request->quyen;
        $user->save();
        return redirect('admin/user/danhsach')->with('thongbao','Sửa Thành công');

    }
    public function getXoa($id){
        $user = User::find($id);
        $user->delete();
        return redirect('admin/user/danhsach')->with('thongbao','Xóa user thành công');
    }
    public function getdangnhapAdmin(){
        return view('admin.login');
    }
    public function postdangnhapAdmin(Request $request){
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
            return redirect('admin/theloai/danhsach');

        }
        else{
            return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
    }
    public function getDangXuatAdmin(){
        Auth::logout();
        return redirect('admin/dangnhap');
    }
    public function username()
    {
        return 'username';
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            $user = Auth::user();
            if($user->quyen ==1){
                View::share('current_user', Auth::user());
                return $next($request);
            }
            else{
                return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
            }

        }
        else{
            return redirect('admin/dangnhap');
        }
    }
}

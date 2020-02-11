<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\TheLoai;
use App\LoaiTin;


Route::get('admin/','UserController@getdangnhapAdmin');
Route::get('admin/dangnhap','UserController@getdangnhapAdmin');
Route::post('admin/dangnhap','UserController@postdangnhapAdmin');
Route::get('admin/logout','UserController@getDangXuatAdmin');
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function (){

    Route::group(['prefix'=>'theloai'],function (){

        //admin/theloai/sua
        Route::get('danhsach','TheLoaiController@getDanhSach');

        Route::get('sua/{id}','TheLoaiController@getSua');
        Route::post('sua/{id}','TheLoaiController@postSua');

        Route::get('them','TheLoaiController@getThem');
        Route::post('them','TheLoaiController@postThem');

        Route::get('xoa/{id}','TheLoaiController@getXoa');
    });
    Route::group(['prefix'=>'loaitin'],function (){

        //admin/loaitin/sua
        Route::get('danhsach','LoaiTinController@getDanhSach');

        Route::get('sua/{id}','LoaiTinController@getSua');
        Route::post('sua/{id}','LoaiTinController@postSua');

        Route::get('them','LoaiTinController@getThem');
        Route::post('them','LoaiTinController@postThem');

        Route::get('xoa/{id}','LoaiTinController@getXoa');


    });
    Route::group(['prefix'=>'tintuc'],function (){

        //admin/tintuc/sua
        Route::get('danhsach','TinTucController@getDanhSach');

        Route::get('sua/{id}','TinTucController@getSua');
        Route::post('sua/{id}','TinTucController@postSua');

        Route::get('them','TinTucController@getThem');
        Route::post('them','TinTucController@postThem');

        Route::get('xoa/{id}','TinTucController@getXoa');

    });
    Route::group(['prefix'=>'ajax'],function (){
        Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
    });

    Route::group(['prefix'=>'comment'],function (){
        Route::get('xoa/{idTinTuc}/{id}','CommentController@getXoa');
    });
    Route::group(['prefix'=>'slide'],function (){

        //admin/slide/sua
        Route::get('danhsach','SlideController@getDanhSach');

        Route::get('sua/{id}','SlideController@getSua');
        Route::post('sua/{id}','SlideController@postSua');

        Route::get('them','SlideController@getThem');
        Route::post('them','SlideController@postThem');

        Route::get('xoa/{id}','SlideController@getXoa');

    });
    Route::group(['prefix'=>'user'],function (){

        //admin/slide/sua
        Route::get('danhsach','UserController@getDanhSach');

        Route::get('sua/{id}','UserController@getSua');
        Route::post('sua/{id}','UserController@postSua');

        Route::get('them','UserController@getThem');
        Route::post('them','UserController@postThem');

        Route::get('xoa/{id}','UserController@getXoa');

    });
});


Route::get('trangchu','PageController@trangchu')->middleware('Login');
Route::get('lienhe','PageController@lienhe')->middleware('Login');
Route::get('loaitin/{id}/{TenKhongDau}.html','PageController@loaitin')->middleware('Login');
Route::get('tintuc/{id}/{TieuDeKhongDau}.html','PageController@tintuc')->middleware('Login');
Route::get('dangnhap','PageController@get');
Route::get('dangnhap','PageController@getDangNhap');
Route::post('dangnhap','PageController@postDangNhap');
Route::get('dangxuat','PageController@getDangXuat');
Route::get('','PageController@trangchu')->middleware('Login');

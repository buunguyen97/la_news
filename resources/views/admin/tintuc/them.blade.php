@extends('admin.layout.index')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin Tức
                        <small>Thêm</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach

                        </div>
                    @endif
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}<br>
                        </div>
                    @endif
                    <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Thể Loại</label>
                            <select class="form-control" name="TheLoai" id="TheLoai">
                                @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại Tin</label>
                            <select class="form-control" name="LoaiTin" id="LoaiTin">
                                @foreach($loaitin as $lt)
                                    <option value="{{$tl->id}}">{{$lt->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tiêu Đề</label>
                            <input class="form-control" name="TieuDe"  placeholder="Nhập tiêu đề "/>
                        </div>
                        <div class="form-group" >
                            <label>Hình Ảnh</label>
                            <input name="Hinh" type="file">
                        </div>
                        <div class="form-group">
                            <label>Tóm Tắt</label>
                            <textarea class="form-control ckeditor" id="demo" name="TomTat" rows="3" placeholder="Nhập tóm tắt"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội Dung</label>
                            <textarea class="form-control ckeditor" id="demo" name="NoiDung" rows="5" placeholder="Nhập nội dung"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Nổi Bật</label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="1" checked="" type="radio">Có
                            </label>
                            <label class="radio-inline">
                                <input name="rdoStatus" value="0" type="radio">Không
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </form>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>



@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#TheLoai').change(function () {
               var idTheLoai = $(this).val();
               $.get("admin/ajax/loaitin/"+idTheLoai,function (data) {
                   $("#LoaiTin").html(data);
               });
            });
        });
    </script>
@endsection

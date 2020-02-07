@extends('admin.layout.index')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin Tức
                        <small>{{$tintuc->TieuDe}}</small>
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
                    <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Thể Loại</label>
                            <select class="form-control" name="TheLoai" id="TheLoai">
                                @foreach($theloai as $tl)
                                    <option
                                        @if($tintuc->loaitin->theloai->id == $tl->id)
                                        {{"selected"}}
                                        @endif

                                        value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại Tin</label>
                            <select class="form-control" name="LoaiTin" id="LoaiTin">
                                @foreach($loaitin as $lt)
                                    <option
                                        @if($tintuc->loaitin->id == $lt->id)
                                        {{"selected"}}
                                        @endif
                                        value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tiêu Đề</label>
                            <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề "
                                   value="{{$tintuc->TieuDe}}"/>
                        </div>
                        <div class="form-group">
                            <label>Hình Ảnh</label>
                            <img style="margin: 20px" width="200px" src="upload/tintuc/{{$tintuc->Hinh}}">
                            <input name="Hinh" type="file">
                        </div>
                        <div class="form-group">
                            <label>Tóm Tắt</label>
                            <textarea class="form-control ckeditor" id="demo" name="TomTat" rows="3"
                                      placeholder="Nhập tóm tắt">{{$tintuc->TomTat}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội Dung</label>
                            <textarea class="form-control ckeditor" id="demo" name="NoiDung" rows="5"
                                      placeholder="Nhập nội dung">{{$tintuc->NoiDung}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nổi Bật</label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="1" type="radio"
                                @if($tintuc->NoiBat == 1)
                                    {{"checked"}}
                                    @endif

                                >Có
                            </label>
                            <label class="radio-inline">
                                <input name="rdoStatus" value="0" type="radio"
                                @if($tintuc->NoiBat == 0)
                                    {{"checked"}}
                                    @endif

                                >Không
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </form>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Comment
                        <small>Danh Sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Người dùng </th>
                        <th>Nội Dung</th>
                        <th>Ngày đăng</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tintuc->comment as $cm)
                        <tr class="odd gradeX" align="center">
                            <td>{{$cm->id}}</td>
                            <td>{{$cm->user->name}}</td>
                            <td>{{$cm->NoiDung}}</td>
                            <td>{{$cm->created_at}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$tintuc->id}}/{{$cm->id}}"> Delete</a></td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
                $.get("admin/ajax/loaitin/" + idTheLoai, function (data) {
                    $("#LoaiTin").html(data);
                });
            });
        });
    </script>
@endsection

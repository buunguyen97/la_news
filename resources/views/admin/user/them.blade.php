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
                    <form action="admin/user/them" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div class="form-group">
                            <label>Tên </label>
                            <input class="form-control" name="name"  placeholder="Nhập tên của bạn "/>
                        </div>
                        <div class="form-group">
                            <label>email </label>
                            <input class="form-control" name="email" type="email" placeholder="Nhập email của bạn "/>
                        </div>
                        <div class="form-group">
                            <label>Password </label>
                            <input class="form-control" name="password" type="password" placeholder="Nhập password của bạn "/>
                        </div>

                        <div class="form-group">
                            <label>Quyền truy cập</label>
                            <label class="radio-inline">
                                <input name="quyen" value="1" checked="" type="radio">Có
                            </label>
                            <label class="radio-inline">
                                <input name="quyen" value="0" type="radio">Không
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

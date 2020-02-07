@extends('admin.layout.index')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{$err}}<br>
                        @endforeach

                    </div>
                @endif
                @if(session('thongbao'))
                    <div class="alert alert-danger">
                        {{session('thongbao')}}<br>
                    </div>
                @endif
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
                        <small>Thêm</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="Ten" value="{{$slide->Ten}}"/>
                        </div>
                        <div class="form-group" >
                            <label>Hình Ảnh</label>
                            <img src="upload/slide/{{$slide->Hinh}}" width="300px" style="margin: 20px" alt="">
                            <input name="Hinh" type="file">
                        </div>
                        <div class="form-group">
                            <label>Nội Dung</label>
                            <textarea class="form-control ckeditor" id="demo" name="NoiDung" >{{$slide->NoiDung}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Link</label>
                            <input class="form-control" name="link" value="{{$slide->link}}"/>
                        </div>

                        <button type="submit" class="btn btn-default">Sửa</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

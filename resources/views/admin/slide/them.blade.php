@extends('admin.layout.index')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
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
                        <div class="alert alert-danger">
                            {{session('thongbao')}}<br>
                        </div>
                    @endif
                    <form action="admin/slide/them" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="Ten" placeholder="Tên Slide"/>
                        </div>
                        <div class="form-group" >
                            <label>Hình Ảnh</label>
                            <input name="Hinh" type="file">
                        </div>
                        <div class="form-group">
                            <label>Nội Dung</label>
                            <textarea class="form-control ckeditor" id="demo" name="NoiDung" ></textarea>
                        </div>
                        <div class="form-group">
                            <label>Link</label>
                            <input class="form-control" name="link" placeholder="Link"/>
                        </div>

                        <button type="submit" class="btn btn-default">Thêm</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

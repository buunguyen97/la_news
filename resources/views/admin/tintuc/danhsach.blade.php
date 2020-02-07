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
                <div class="alert alert-success">
                    {{session('thongbao')}}<br>
                </div>
            @endif
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>Danh sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Tiêu Đề</th>
                    <th>Tóm Tắt </th>
                    <th>Thể Loại</th>
                    <th>Loại Tin</th>
                    <th>Số lượt xem</th>
                    <th>Nổi Bật</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tintuc as $tt)
                    <tr class="odd gradeX" align="center">
                        <td>{{$tt->id}}</td>
                        <td>{{$tt->TieuDe}}</td>
                        <td>{{$tt->TomTat}}</td>
                        <td>{{$tt->loaitin->theloai->Ten}}</td>
                        <td>{{$tt->loaitin->Ten}}</td>
                        <td>{{$tt->SoLuotXem}}
                        <td>
                            @if (($tt->NoiBat)==1)
                                {{ 'Có' }}
                            @else
                                {{ 'Không' }}
                            @endif
                        </td>

                        </td>

                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{$tt->id}}"> Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{$tt->id}}">Edit</a></td>
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

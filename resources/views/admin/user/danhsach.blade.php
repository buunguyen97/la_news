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
                    <h1 class="page-header">User
                        <small>Danh Sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Quyền</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user as $us)
                        <tr class="odd gradeX" align="center">
                            <td>{{$us->id}}</td>
                            <td>{{$us->name}}</td>
                            <td>{{$us->email}}</td>
                            <td>
                                @if($us->quyen == 1)
                                    {{'Được truy cập'}}
                                @else
                                    {{'Không được truy cập'}}
                                @endif
                            </td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/user/xoa/{{$us->id}}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/user/sua/{{$us->id}}">Edit</a></td>
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

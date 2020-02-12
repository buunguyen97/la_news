@extends('layouts.index')
@section('content')
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    <a href="#">{{$tintuc->loaitin->Ten}}</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on: {{$tintuc->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">{!! $tintuc->TomTat !!}</p>
                <p>{!! $tintuc->NoiDung !!}</p>
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                @if(session('thongbao'))
                    <div class="alert alert-success">
                      {{session('thongbao')}}
                    </div>
                @endif
                @if(isset($nguoidung))
                    <div class="well">
                        <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                        <form role="form" action="comment/{{$tintuc->id}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <textarea class="form-control" name="NoiDung" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>
                    </div>
                @endif
                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                @foreach($tintuc->comment as $cm)
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$cm->user->name}}
                                <small>{{$cm->created_at}}</small>
                            </h4>
                            {!! $cm->NoiDung !!}
                        </div>
                    </div>
            @endforeach
            <!-- Comment -->


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">
                    @foreach($tinlienquan as $tlq)
                        <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="tintuc/{{$tlq->id}}/{{$tlq->TieuDeKhongDau}}.html">
                                        <img class="img-responsive" src="upload/tintuc/{{$tlq->Hinh}}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="tintuc/{{$tlq->id}}/{{$tlq->TieuDeKhongDau}}.html"><b>{!! $tlq->TieuDe !!}</b></a>
                                </div>
                                <a class="btn btn-primary" href="tintuc/{{$tlq->id}}/{{$tlq->TieuDeKhongDau}}.html">Xem
                                    thêm<span
                                        class="glyphicon glyphicon-chevron-right"></span></a>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                    @endforeach
                    <!-- item -->

                        <!-- end item -->
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                    @foreach($tinnoibat as $tnb)
                        <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="tintuc/{{$tnb->id}}/{{$tnb->TieuDeKhongDau}}.html">
                                        <img class="img-responsive" src="upload/tintuc/{{$tnb->Hinh}}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="tintuc/{{$tnb->id}}/{{$tnb->TieuDeKhongDau}}.html"><b>{!! $tnb->TieuDe !!}</b></a>
                                </div>
                                <a class="btn btn-primary" href="tintuc/{{$tnb->id}}/{{$tnb->TieuDeKhongDau}}.html">Xem
                                    thêm<span
                                        class="glyphicon glyphicon-chevron-right"></span></a>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                    @endforeach
                    <!-- item -->

                        <!-- end item -->
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->
    </div>
@endsection

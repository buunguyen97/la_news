<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">Admin Area - Buu Nguyen</a>
    </div>
    <!-- /.navbar-header -->

    <div class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->

        <div class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>

            <ul class="dropdown-menu dropdown-user">
                @if(isset($current_user))
                    <li><a href="#"><i class="fa fa-user fa-fw"></i>{{$current_user->name}}</a>
                    </li>
                    <li><a href="admin/user/sua/{{$current_user->id}}"><i class="fa fa-gear fa-fw"></i> Sửa thông tin</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="admin/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                @endif
            </ul>
            <!-- /.dropdown-user -->
        </div>
        <!-- /.dropdown -->
    </div>

    <!-- /.navbar-top-links -->

@include('admin.layout.menu')
<!-- /.navbar-static-side -->
</nav>

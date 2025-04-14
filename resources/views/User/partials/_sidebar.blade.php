<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            {{-- <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li> --}}
            <li>
                <a href="{{route('home')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{ route('workerIndex') }}"><i class="fa fa-bar-chart-o fa-fw"></i> @lang('Worker/dashboard.Today') @lang('Worker/dashboard.Jobs')</a>
            </li>
            <li>
                <a href="{{ route('myJobs') }}"><i class="fa fa-table fa-fw"></i> @lang('Worker/dashboard.My') @lang('Worker/dashboard.Jobs')</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->

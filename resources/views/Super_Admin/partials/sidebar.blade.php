<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{Auth::user()->name}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    {{-- <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="@lang('Super_Admin/dashboard.Search')">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form> --}}
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">@lang('Super_Admin/dashboard.Main') @lang('Super_Admin/dashboard.Navigation')</li>
      <li>
        <a href="{{route('sup_admin.dashboard')}}">
          <i class="fa fa-dashboard"></i> <span>@lang('Super_Admin/dashboard.Dashboard')</span>
        </a>
      </li>

      <li>
          <a href="{{route('sup_admin.profile')}}"><i class="fa fa-user"></i> @lang('Company_Admin/dashboard.Profile')</a>
      </li>

      <li>
        <a href="{{route('supadmin.companiesIndex')}}">
          <i class="fa fa-sitemap" aria-hidden="true"></i> <span>@lang('common.Companies Management')</span>
        </a>
      </li>

      <li>
          <a href="{{route('sup_customer.index')}}"><i class="fa fa-phone"></i> @lang('common.Customers Management')  </a>
      </li>

      <!--li>
          <a href="{{route('element.index')}}"><i class="fa fa-wrench"></i> @lang('common.Elements Management')</a>
      </li-->

      {{-- <li>
        <a href="{{route('floor.index')}}"><i class="glyphicon glyphicon-tower"></i> @lang('common.Floors Management')</a>
      </li> --}}

      <li>
        <a href="{{route('floorType.index')}}"><i class="glyphicon glyphicon-object-align-bottom"></i> @lang('common.Element Types Management')</a>
      </li>

      <!-- <li>
        <a href="{{route('sup_admin.payments')}}">
          <i class="fa fa-usd" aria-hidden="true"></i> <span>@lang('common.Payments Management')</span>
        </a>
      </li> -->
      <li>
        <a href="{{route('sup_admin.permissionsIndex')}}">
          <i class="fa fa-hand-paper-o" aria-hidden="true"></i> <span>@lang('common.Permissions Management')</span>
        </a>
      </li>
      <li>
        <a href="{{route('sup_admin.rolesIndex')}}">
          <i class="fa fa-diamond" aria-hidden="true"></i> <span>@lang('common.Roles Management')</span>
        </a>
      </li>
      <li>
          <a href="{{route('roomType.index')}}"><i class="glyphicon glyphicon-flag"></i>@lang('common.Room Types Management')</a>
      </li>

      <li>
          <a href="{{route('methodCategory.index')}}"><i class="fa fa-folder"></i> @lang('common.Method Category Management')</a>
      </li>

      <li>
          <a href="{{route('healthCategory.index')}}"><i class="fa fa-folder"></i> @lang('common.Health Category Management')</a>
      </li>

      <li>
          <a href="{{route('method.index')}}"><i class="glyphicon glyphicon-tasks"></i> @lang('common.Methods Management')</a>
      </li>

      <li>
        <a href="{{route('health.index')}}"><i class="fa fa-heart"></i> @lang('common.Health And Safety Management')</a>
      </li>

      <li>
        <a href="{{route('blogs.index')}}"><i class="fa fa-heart"></i> @lang('common.Blog Management')</a>
      </li>

      <li>
        <a href="{{route('hourlyRateIndex')}}"><i class="fa fa-clock-o"></i> @lang('common.Workers Hourly Rate Management')</a>
      </li>

      <li>
        <a href="{{route('supadmin.workersIndex')}}">
          <i class="fa fa-codepen"></i> <span>@lang('common.Workers Management')</span>
        </a>
      </li>

         <li>
            <a href="{{route('modulePrice.index')}}"><i class="fa fa-codepen"></i> <span>Module Prices</span></a>
        </li>

      <!-- <li>
        <a href="{{route('workerTypes.index')}}">
          <i class="fa fa-wrench" aria-hidden="true"></i> <span>@lang('common.Worker') @lang('Super_Admin/dashboard.Types') @lang('Super_Admin/dashboard.Management')</span>
        </a>
      </li> -->
  </section>
  <!-- /.sidebar -->
</aside>

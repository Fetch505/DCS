<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{Auth::user()->name}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">@lang('Super_Admin/dashboard.Main') @lang('Super_Admin/dashboard.Navigation')</li>

      <li class="{{ request()->routeIs('sup_admin.dashboard') ? 'active' : '' }}">
        <a href="{{route('sup_admin.dashboard')}}">
          <i class="fa fa-dashboard"></i> <span>@lang('Super_Admin/dashboard.Dashboard')</span>
        </a>
      </li>

      <li class="{{ request()->routeIs('sup_admin.profile') ? 'active' : '' }}">
        <a href="{{route('sup_admin.profile')}}"><i class="fa fa-user"></i> @lang('Company_Admin/dashboard.Profile')</a>
      </li>

      <!-- Company Management Dropdown -->
      <li class="treeview {{ request()->routeIs('supadmin.companiesIndex') || request()->routeIs('sup_customer.index') || request()->routeIs('floorType.index') || request()->routeIs('roomType.index') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-building"></i>
          <span>@lang('common.Company Management')</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="{{ request()->routeIs('supadmin.companiesIndex') ? 'active' : '' }}">
            <a href="{{route('supadmin.companiesIndex')}}"><i class="fa fa-sitemap"></i> @lang('common.Companies Management')</a>
          </li>
          <li class="{{ request()->routeIs('sup_customer.index') ? 'active' : '' }}">
            <a href="{{route('sup_customer.index')}}"><i class="fa fa-phone"></i> @lang('common.Customers Management')</a>
          </li>
          <li class="{{ request()->routeIs('floorType.index') ? 'active' : '' }}">
            <a href="{{route('floorType.index')}}"><i class="glyphicon glyphicon-object-align-bottom"></i> @lang('common.Element Types Management')</a>
          </li>
          <li class="{{ request()->routeIs('roomType.index') ? 'active' : '' }}">
            <a href="{{route('roomType.index')}}"><i class="glyphicon glyphicon-flag"></i> @lang('common.Room Types Management')</a>
          </li>
        </ul>
      </li>

      <!-- Access Control Dropdown -->
      <li class="treeview {{ request()->routeIs('sup_admin.permissionsIndex') || request()->routeIs('sup_admin.rolesIndex') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-lock"></i>
          <span>@lang('common.Access Control')</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="{{ request()->routeIs('sup_admin.permissionsIndex') ? 'active' : '' }}">
            <a href="{{route('sup_admin.permissionsIndex')}}"><i class="fa fa-hand-paper-o"></i> @lang('common.Permissions Management')</a>
          </li>
          <li class="{{ request()->routeIs('sup_admin.rolesIndex') ? 'active' : '' }}">
            <a href="{{route('sup_admin.rolesIndex')}}"><i class="fa fa-diamond"></i> @lang('common.Roles Management')</a>
          </li>
        </ul>
      </li>

      <!-- Methods & Health Dropdown -->
      <li class="treeview {{ request()->routeIs('methodCategory.index') || request()->routeIs('healthCategory.index') || request()->routeIs('method.index') || request()->routeIs('health.index') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-medkit"></i>
          <span>@lang('common.Methods & Health')</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="{{ request()->routeIs('methodCategory.index') ? 'active' : '' }}">
            <a href="{{route('methodCategory.index')}}"><i class="fa fa-folder"></i> @lang('common.Method Category Management')</a>
          </li>
          <li class="{{ request()->routeIs('healthCategory.index') ? 'active' : '' }}">
            <a href="{{route('healthCategory.index')}}"><i class="fa fa-folder"></i> @lang('common.Health Category Management')</a>
          </li>
          <li class="{{ request()->routeIs('method.index') ? 'active' : '' }}">
            <a href="{{route('method.index')}}"><i class="glyphicon glyphicon-tasks"></i> @lang('common.Methods Management')</a>
          </li>
          <li class="{{ request()->routeIs('health.index') ? 'active' : '' }}">
            <a href="{{route('health.index')}}"><i class="fa fa-heart"></i> @lang('common.Health And Safety Management')</a>
          </li>
        </ul>
      </li>

      <!-- Blog Management -->
      <li class="{{ request()->routeIs('blogs.index') ? 'active' : '' }}">
        <a href="{{route('blogs.index')}}"><i class="fa fa-heart"></i> @lang('common.Blog Management')</a>
      </li>

      <!-- Workers & Rates Dropdown -->
      <li class="treeview {{ request()->routeIs('hourlyRateIndex') || request()->routeIs('supadmin.workersIndex') || request()->routeIs('modulePrice.index') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>@lang('common.Workers & Rates')</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="{{ request()->routeIs('hourlyRateIndex') ? 'active' : '' }}">
            <a href="{{route('hourlyRateIndex')}}"><i class="fa fa-clock-o"></i> @lang('common.Workers Hourly Rate Management')</a>
          </li>
          <li class="{{ request()->routeIs('supadmin.workersIndex') ? 'active' : '' }}">
            <a href="{{route('supadmin.workersIndex')}}"><i class="fa fa-codepen"></i> @lang('common.Workers Management')</a>
          </li>
          <li class="{{ request()->routeIs('modulePrice.index') ? 'active' : '' }}">
            <a href="{{route('modulePrice.index')}}"><i class="fa fa-tags"></i> Module Prices</a>
          </li>
        </ul>
      </li>

      <!-- Uncommented sections remain untouched -->
      <!--li>
          <a href="{{route('element.index')}}"><i class="fa fa-wrench"></i> @lang('common.Elements Management')</a>
      </li-->

      {{-- <li>
        <a href="{{route('floor.index')}}"><i class="glyphicon glyphicon-tower"></i> @lang('common.Floors Management')</a>
      </li> --}}

      <!-- <li>
        <a href="{{route('sup_admin.payments')}}">
          <i class="fa fa-usd" aria-hidden="true"></i> <span>@lang('common.Payments Management')</span>
        </a>
      </li> -->

      <!-- <li>
        <a href="{{route('workerTypes.index')}}">
          <i class="fa fa-wrench" aria-hidden="true"></i> <span>@lang('common.Worker') @lang('Super_Admin/dashboard.Types') @lang('Super_Admin/dashboard.Management')</span>
        </a>
      </li> -->
    </ul>
  </section>
</aside>

<!DOCTYPE html>
<html>
  @include('Super_Admin.partials.header')

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

      @include('Super_Admin.partials.topbar')
      <!-- Left side column. contains the logo and sidebar -->
      @include('Super_Admin.partials.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          @include('Super_Admin.partials._messages')
          @yield('content')
      </div>
      <!-- /.content-wrapper -->
      @include('Super_Admin.partials.footer')

      <!-- Control Sidebar -->
      @include('Super_Admin.partials.control_sidebar')

  </div>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

<!-- ./wrapper -->

<!-- jQuery 3 -->
@include('Super_Admin.partials.script')

</body>
</html>

<!DOCTYPE html>
<html>
  @include('Customer.partials.header')

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

      @include('Customer.partials.topbar')
      <!-- Left side column. contains the logo and sidebar -->
      @include('Customer.partials.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          @include('Customer.partials._messages')
          @yield('content')
      </div>
      <!-- /.content-wrapper -->
      @include('Customer.partials.footer')

      <!-- Control Sidebar -->
      @include('Customer.partials.control_sidebar')

  </div>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

<!-- ./wrapper -->

<!-- jQuery 3 -->
@include('Customer.partials.script')

</body>
</html>

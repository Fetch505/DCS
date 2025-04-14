<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    @include('Company_Admin.partials._header')
    <style media="screen">
    .dataTables_filter {
         float:right;
      }
    </style>
    @yield('outer_css')
  </head>
  <body>
    <div id="wrapper">
      @include('Company_Admin.partials._topbar')
      <!--Sidebar is inside the Topbar partials file -->
      <div> <div id="page-wrapper">
        @include('Company_Admin.partials._messages')
        @yield('content')
      </div>
    </div>

    @include('Company_Admin.partials._script')
  </body>
</html>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    @include('User.partials._header')
  </head>
  <body>
    <div id="wrapper">
      @include('User.partials._topbar')
      <!--Sidebar is inside the Topbar partials file -->
      <div <div id="page-wrapper">
        @yield('content')
      </div>
    </div>

    @include('User.partials._script')
  </body>
</html>

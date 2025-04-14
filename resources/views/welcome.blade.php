<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- <html lang="en"> -->

<head>
  @include('landing_page.partials._header')
  @yield('outer_css')
</head>

<body id="page-top">

  <!-- Navigation -->
  @include('landing_page.partials._topbar')
  @include('landing_page.partials._services')
  @include('landing_page.partials._scripts')

  <!-- Header -->


  <!-- Bootstrap core JavaScript -->

</body>

</html>

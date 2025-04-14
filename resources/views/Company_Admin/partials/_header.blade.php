
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Digital Cleaning - @yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('public/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/js/test/dist/vue-phone-number-input.css')}}" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="{{asset('public/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('public/dist2/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{asset('public/vendor/morrisjs/morris.css')}}" rel="stylesheet">

    <link href="{{asset('public/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="{{asset('public\css\ownStyles.css')}}" rel="stylesheet" type="text/css">

    <!-- Select 2 -->
    <!-- <script src="{{asset('public/js/jquery/dist/jquery.min.js')}}"></script> -->

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->

    <!-- <script src="{{asset('public/select2/dist/js/select2.min.js')}}">
    </script> -->


    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> -->

    <style media="screen">
    table{
        table-layout: fixed;
        width: 100px;
      }

      table td{
          word-wrap: break-word;
        }
    </style>

    <script>
      var APP_URL = {!! json_encode(url('/').'/') !!}
    </script>

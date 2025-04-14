@extends('Company_Admin.layouts.main')

@section('title', 'Dashboard')
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>

  <div id="wrapper">
    @section('content')
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Material Order Management')</h1>
      </div>
      <div class="col-md-4 text-right">
        <a href="{{ route('material-order') }}" class="btn btn-success"  style="margin-top: 30px;">@lang('Company_Admin/dashboard.Order') @lang('Company_Admin/dashboard.Materials')</a>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary pull-right" href="{{route('material.index')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Back')</a>
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('Company_Admin/dashboard.List Of All') @lang('Company_Admin/dashboard.Material') @lang('Company_Admin/dashboard.Order')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" id="table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Company_Admin/dashboard.Order') ID</th>
                                <th>@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Quantity')</th>
                                <th>@lang('Company_Admin/dashboard.Order') @lang('Company_Admin/dashboard.Date')</th>
                                <th data-orderable="false"></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($orders as $key => $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->created_at? date("Y-m-d", strtotime($order->created_at)) : '' }}</td>
                                <td style="text-align:center;">
                                    <a href="{{route('MaterialOrderDetails',$order->id)}}"  data-toggle="tooltip" data-placement="top" title="@lang('Company_Admin/dashboard.View')@lang('Company_Admin/dashboard.Order')@lang('Company_Admin/dashboard.Details') "><i class="fa fa-eye view-icon" style="color:blue;"></i></a>
                                </td>
                            </tr>
                          @endforeach

                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    @endsection
  </div>

  @section('outer_script')
    <script src="{{asset('public/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('public/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
    <script src="{{asset('public/dist2/js/sb-admin-2.js')}}"></script>
  <script>

  ///////////////// Below block is used to localize DataTable data //////////////
   let languageSelected = document.getElementById('languageSwitcher').value;

   if(languageSelected == 'en') {
     $(function () {
       $('#table').DataTable()
     })

   }
  /////////////////////////////////////////////////////////////////////////

  </script>
  @endsection
<!-- Content Header (Page header) -->

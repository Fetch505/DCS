@extends('Company_Admin.layouts.main')

@section('outer_css')
  <link href="{{asset('multiple-select/multiple-select.css')}}" rel="stylesheet"/>
@endsection

@section('title', 'Dashboard')

  <div id="wrapper">
    @section('content')
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Material Order Management')</h1>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
          <a class="btn btn-primary btn-md pull-right" href="{{route('showMaterialOrders')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Back')</a>
            <div class="panel panel-info">

                <div class="panel-heading">
                    @lang('Company_Admin/dashboard.Material') @lang('Company_Admin/dashboard.Order') @lang('Company_Admin/dashboard.Details')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <div class="col-md-8 col-md-offset-2">
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Order') ID:</label>
                      <span style="position: absolute; left: 250px;">{{ $order->id }}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Order') @lang('Company_Admin/dashboard.Date'):</label>
                      <span style="position: absolute; left: 250px;">{{ $order->created_at? date("Y-m-d", strtotime($order->created_at)) : '' }}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Quantity'):</label>
                      <span style="position: absolute; left: 250px;">{{ $order->quantity }}</span>
                    </div>

                    <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('Company_Admin/dashboard.Sr #')</th>
                                <th>@lang('Company_Admin/dashboard.Material')</th>
                                <th>@lang('Company_Admin/dashboard.Quantity')</th>
                                <th>@lang('Company_Admin/dashboard.Project')</th>
                                <th>@lang('Company_Admin/dashboard.Supplier')</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($order->orderDetails as $key => $orderDetail)
                            <tr>
                                <td>{{ ++$key}}</td>
                                <td>{{ $orderDetail->material->name }}</td>
                                <td>{{ $orderDetail->quantity }}</td>
                                <td>{{ $orderDetail->project }}</td>
                                <td>{{ $orderDetail->supplier->name }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>


                  </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    @endsection
  </div>

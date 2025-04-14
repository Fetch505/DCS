@extends('Company_Admin.layouts.main')

@section('outer_css')
  <link href="{{asset('multiple-select/multiple-select.css')}}" rel="stylesheet"/>
@endsection

@section('title', 'Dashboard')

  <div id="wrapper">
    @section('content')
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('Company_Admin/dashboard.Materials') @lang('Company_Admin/dashboard.Management')</h1>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
          <a class="btn btn-primary btn-md pull-right" href="{{route('material.index')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Back')</a>
            <div class="panel panel-info">

                <div class="panel-heading">
                    @lang('Company_Admin/dashboard.Material') @lang('Company_Admin/dashboard.Details')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <div class="col-md-8 col-md-offset-2">
                    <div class="inline">
                      <label for="name">@lang('common.Category'):</label>
                      <span style="position: absolute; left: 250px;">{{$material->materialType->materialCategory->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Type'):</label>
                      <span style="position: absolute; left: 250px;">{{$material->materialType->name }}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Name'):</label>
                      <span style="position: absolute; left: 250px;">{{$material->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Price'):</label>
                      <span style="position: absolute; left: 250px;">{{$material->price}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Unassigned') @lang('Company_Admin/dashboard.Quantity'):</label>
                      <span style="position: absolute; left: 250px;">{{$material->quantity}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Minimum') @lang('Company_Admin/dashboard.Quantity'):</label>
                      <span style="position: absolute; left: 250px;">{{$material->limit}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Suppliers'):</label>
                      <ul style="padding-left:250px; list-style-type:square">
                        @foreach ($material->suppliers as $suppliers)
                          <li> <i>{{$suppliers->name}}</i> </li>
                        @endforeach
                      </ul>
                    </div>

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


<!-- Content Header (Page header) -->

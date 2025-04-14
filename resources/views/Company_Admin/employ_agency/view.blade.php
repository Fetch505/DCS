@extends('Company_Admin.layouts.main')
@section('title', 'Dashboard')

  <div id="wrapper">
    @section('content')
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Employment Agencies Management')</h1>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
          <a class="btn btn-primary btn-md pull-right" href="{{route('employ_agency.index')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i>@lang('Company_Admin/dashboard.Back')</a>
            <div class="panel panel-info">

                <div class="panel-heading">
                  @lang('common.Employment agency details')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <div class="col-md-8 col-md-offset-4">
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Name'):</label>
                      <span style="position: absolute; left: 150px;">{{$employAgency->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Email'):</label>
                      <span style="position: absolute; left: 150px;">{{$employAgency->email}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Phone'):</label>
                      <span style="position: absolute; left: 150px;">{{$employAgency->phone}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Address'):</label>
                      <span style="position: absolute; left: 150px;">{{$employAgency->address}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('common.URL'):</label>
                      <span style="position: absolute; left: 150px;">
                        <a href="{{$employAgency->url}}">{{$employAgency->url}}</a> </span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Country'):</label>
                      <span style="position: absolute; left: 150px;">{{$employAgency->country}}</span>
                    </div>
                    <br>
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

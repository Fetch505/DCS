@extends('Company_Admin.layouts.main')

@section('outer_css')
  <link href="{{asset('multiple-select/multiple-select.css')}}" rel="stylesheet"/>
@endsection

@section('title', 'Dashboard')

  <div id="wrapper">
    @section('content')
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('Company_Admin/dashboard.Material') @lang('Company_Admin/dashboard.Types') @lang('Company_Admin/dashboard.Management')</h1>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
          <a class="btn btn-primary btn-md pull-right" href="{{route('materialType.index')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Back')</a>
            <div class="panel panel-info">

                <div class="panel-heading">
                    @lang('Company_Admin/dashboard.Material') @lang('Company_Admin/dashboard.Types') @lang('Company_Admin/dashboard.Details')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <div class="col-md-8 col-md-offset-2">
                    <div class="inline">
                      <label for="name">@lang('Common.Category'):</label>
                      <span style="position: absolute; left: 250px;">{{$materialType->materialCategory->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Name'):</label>
                      <span style="position: absolute; left: 250px;">{{$materialType->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Materials'):</label>
                      <ul style="padding-left:250px; list-style-type:square">
                        @foreach ($materialType->materials as $material)
                          <li> <i>{{$material->name}}</i> </li>
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

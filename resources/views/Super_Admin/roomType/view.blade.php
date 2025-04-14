@extends('Super_Admin.layouts.admin')

@section('outer_css')
  <link href="{{asset('public/multiple-select/multiple-select.css')}}" rel="stylesheet"/>
@endsection

@section('title', 'Dashboard')

@section('content')
  <section class="content">
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
                  <div class="col-md-8 col-md-offset-4">
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Name'):</label>
                      <span style="position: absolute; left: 150px;">{{$material->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Price'):</label>
                      <span style="position: absolute; left: 150px;">{{$material->price}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Suppliers'):</label>
                      <ul style="padding-left:150px; list-style-type:square">
                        @foreach ($material->suppliers as $suppliers)
                          <li> <i>{{$suppliers->name}}</i> </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection

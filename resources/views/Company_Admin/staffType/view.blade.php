@extends('Company_Admin.layouts.main')

@section('outer_css')
  <link href="{{asset('multiple-select/multiple-select.css')}}" rel="stylesheet"/>
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
          <a class="btn btn-primary btn-md pull-right" href="{{route('staff.index')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Back')</a>
            <div class="panel panel-info">

                <div class="panel-heading">
                    @lang('Company_Admin/dashboard.Material') @lang('Company_Admin/dashboard.Details')
                </div>
                <div class="panel-body">
                  <div class="col-md-8 col-md-offset-4">
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Name'):</label>
                      <span style="position: absolute; left: 150px;">{{$user->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Worker') @lang('Super_Admin/dashboard.Type'):</label>
                      <span style="position: absolute; left: 150px;">{{$user->worker_type->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Role'):</label>
                      <span style="position: absolute; left: 150px;">{{$user->role->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Email'):</label>
                      <span style="position: absolute; left: 150px;">{{$user->email}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Address'):</label>
                      <span style="position: absolute; left: 150px;">{{$user->address}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Phone'):</label>
                      <span style="position: absolute; left: 150px;">{{$user->phone}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.City'):</label>
                      <span style="position: absolute; left: 150px;">{{$user->city}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Zip Code'):</label>
                      <span style="position: absolute; left: 150px;">{{$user->zipcode}}</span>
                    </div>
                    <br>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Permissions Assigned'):</label>
                      <ul style="padding-left:150px; list-style-type:square">
                        @foreach ($user->permissions as $permission)
                          <li> <i>{{$permission->name}}</i> </li>
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


<!-- Content Header (Page header) -->

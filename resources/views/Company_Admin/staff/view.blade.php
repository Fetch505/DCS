@extends('Company_Admin.layouts.main')

@section('outer_css')
  <link href="{{asset('/multiple-select/multiple-select.css')}}" rel="stylesheet"/>
@endsection

@section('title', 'Dashboard')

<div id="wrapper">
  @section('content')
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Staff Management')</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <a class="btn btn-md btn-danger pull-right" name="button" href="{{route('staffPdf',$user->id)}}"><i class="far fa-file-pdf"></i> @lang('Company_Admin/dashboard.Download') PDF</a>
        <a class="btn btn-primary btn-md pull-right" href="{{route('staff.index')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Back')</a>
        <div class="panel panel-info">

          <div class="panel-heading">
            @lang('common.Staff details')
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <div class="col-md-8 col-md-offset-4">
              <div class="inline">
                <label for="name" style="display: inline-block; width: 200px; vertical-align: middle;">@lang('Company_Admin/dashboard.Name'):</label>
                <span style="display: inline-block; vertical-align: top;">{{$user->name}}</span>
              </div>

              <br>

              <div class="inline">
                <label for="name" style="display: inline-block; width: 200px; vertical-align: middle;">@lang('Company_Admin/dashboard.Employee Code'):</label>
                <span style="display: inline-block; vertical-align: top;">{{$user->employee_code}}</span>
              </div>
              <br>

              <div class="inline">
                <label for="agency" style="display: inline-block; width: 200px; vertical-align: middle;">@lang('common.Associated agency'):</label>
                <span style="display: inline-block; vertical-align: top;">{{ ($user->employment_agency_id) ? $user->agency->name: $user->companyName['name'] }}</span>
              </div>

              <br>

              @if($user->shift_id)
                <div class="inline">
                  <label for="shift" style="display: inline-block; width: 200px; vertical-align: middle;">@lang('Company_Admin/dashboard.Shift'):</label>
                  <span style="display: inline-block; vertical-align: top;">{{ ($user->shift_id) ? $user->shift->title: '' }}</span>
                </div>
                <br>
              @endif

              <div class="inline">
                <label for="name" style="display: inline-block; width: 200px; vertical-align: middle;">@lang('common.Worker type'):</label>
                <span style="display: inline-block; vertical-align: top;">{{ ($user->worker_type_id) ? $user->worker_type->name: ''}}</span>
              </div>

              <br>

              <div class="inline">
                <label for="name" style="display: inline-block; width: 200px; vertical-align: middle;">@lang('Company_Admin/dashboard.Role'):</label>
                <span style="display: inline-block; vertical-align: top;">{{$user->role->name}}</span>
              </div>

              <br>

              <div class="inline">
                <label for="name" style="display: inline-block; width: 200px; vertical-align: middle;">@lang('Company_Admin/dashboard.Email'):</label>
                <span style="display: inline-block; vertical-align: top;">{{$user->email}}</span>
              </div>

              <br>

              <div class="inline">
                <label for="name" style="display: inline-block; width: 200px; vertical-align: middle;">@lang('Company_Admin/dashboard.Gender'):</label>
                <span style="display: inline-block; vertical-align: top;">{{$user->gender}}</span>
              </div>

              <br>

              <div class="inline">
                <label for="name" style="display: inline-block; width: 200px; vertical-align: middle;">@lang('Company_Admin/dashboard.Visa Expiry Date'):</label>
                <span style="display: inline-block; vertical-align: top;">{{$user->visa_expiry_date}}</span>
              </div>

              <br>

              <div class="inline">
                <label for="name" style="display: inline-block; width: 200px; vertical-align: middle;">@lang('Company_Admin/dashboard.Passport Expiry Date'):</label>
                <span style="display: inline-block; vertical-align: top;">{{$user->passport_expiry_date}}</span>
              </div>

              <br>

              <div class="inline">
                <label for="name" style="display: inline-block; width: 200px; vertical-align: middle;"> @lang('Company_Admin/dashboard.Health Card Expiry Date'):</label>
                <span style="display: inline-block; vertical-align: top;">{{$user->health_card_expiry_date}}</span>
              </div>

              <br>
              {{--                    <br>--}}
              <div class="inline">
                @if(Auth::user()->companyAllowedSickLeaves(Auth::user()->id))
                  <label for="name" style="display: inline-block; width: 200px; vertical-align: middle;">@lang('Company_Admin/dashboard.Permissions Assigned'):</label>
                  <ul style="padding-left:150px; list-style-type:square">
                    @foreach ($user->permissions as $permission)
                      <li> <i>{{$permission->name}}</i> </li>
                    @endforeach
                  </ul>
                @endif
              </div>

            </div>
            <div class="inline">
              <label for="name">@lang('Company_Admin/dashboard.Projects'):</label>
            </div>
              <table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>@lang('Company_Admin/dashboard.Project')</th>
                    <th>@lang('Company_Admin/dashboard.Customer name')</th>
                    <th>@lang('Company_Admin/dashboard.Status')</th>
                    <th>@lang('Company_Admin/dashboard.Start Date')</th>
                    <th>@lang('Company_Admin/dashboard.End Date')</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($projects as $key => $project)
                  <tr>
                    <td>{{$project->name}}</td>
                    <td>{{$project->customer->name }}</td>
                    <td>{{$project->status }}</td>
                    <td>{{ date('M j, Y', strtotime($project->start_date)) }}</td>
                    <td>{{ date('M j, Y', strtotime($project->end_date)) }}</td>

                  </tr>
                  @endforeach
                </tbody>
              </table>

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

@extends('Super_Admin.layouts.admin')

@section('outer_css')
  <link href="{{asset('multiple-select/multiple-select.css')}}" rel="stylesheet"/>
@endsection

@section('title', 'Dashboard')

@section('content')
  <section class="content">
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('Company_Admin/dashboard.Tasks') @lang('Company_Admin/dashboard.Management')</h1>
      </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
          <a class="btn btn-primary btn-md pull-right" href="{{route('task.index')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Back')</a>
            <div class="panel panel-info">
                <div class="panel-heading">
                    @lang('Company_Admin/dashboard.Task') @lang('Company_Admin/dashboard.Details')
                </div>
                <div class="panel-body">
                  <div class="col-md-8 col-md-offset-4">
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Task') @lang('Company_Admin/dashboard.Name'):</label>
                      <span style="position: absolute; left: 150px;">{{$task->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Description'):</label>
                      <span style="position: absolute; left: 150px;">{{$task->description}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Customer'):</label>
                      <span style="position: absolute; left: 150px;">{{$task->area->project->customer->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Project'):</label>
                      <span style="position: absolute; left: 150px;">{{$task->area->project->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Area'):</label>
                      <span style="position: absolute; left: 150px;">{{$task->area->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Worker'):</label>
                      <span style="position: absolute; left: 150px;"></span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Start Date'):</label>
                      <span style="position: absolute; left: 150px;">{{date('M j, Y', strtotime($task->start_date))}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.End Date'):</label>
                      <span style="position: absolute; left: 150px;">{{$task->end_date ? date('M j, Y', strtotime($task->end_date)) : 'Not Completed Yet' }}</span>
                    </div>
                    <br>
                    <br>
                    <h3> <u>@lang('Company_Admin/dashboard.Materials')</u> :</h3>
                    <div class="inline">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <span style="position: absolute; left: 150px;">
                            <tr>
                              <th>@lang('Company_Admin/dashboard.Material')</th>
                              <th>@lang('Company_Admin/dashboard.Price')</th>
                            </tr>
                            </span>
                          </thead>
                          <tbody>
                            @foreach($task->materials as $key => $material)
                            <span style="position: absolute; left: 150px;">
                            <tr>
                              <td>{{$material->name}}</td>
                              <td>{{$material->price}}</td>
                            </tr>
                            </span>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection

@extends('Customer.layouts.admin')



@section('title', 'Dashboard')

  <div id="wrapper">
    @section('content')
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('Customer/dashboard.My') @lang('Customer/dashboard.Projects')</h1>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
          <a class="btn btn-primary btn-md pull-right" href="{{route('customer.myProjects')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('Customer/dashboard.Back')</a>
            <div class="panel panel-info">

                <div class="panel-heading">
                    @lang('Customer/dashboard.Project') @lang('Customer/dashboard.Details')

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <div class="col-md-8 col-md-offset-4">
                    <div class="inline">
                      <label for="name">@lang('Customer/dashboard.Project')  @lang('Customer/dashboard.Name') :</label>
                      <span style="position: absolute; left: 150px;">{{$project->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Customer/dashboard.Description') :</label>
                      <span style="position: absolute; left: 150px;">{{$project->description}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Customer/dashboard.Customer') :</label>
                      <span style="position: absolute; left: 150px;">{{$project->customer->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Customer/dashboard.Phone') :</label>
                      <span style="position: absolute; left: 150px;">{{$project->phone}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Customer/dashboard.Address') :</label>
                      <span style="position: absolute; left: 150px;">{{$project->address}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Customer/dashboard.Zip Code') :</label>
                      <span style="position: absolute; left: 150px;">{{$project->zipcode}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Customer/dashboard.Country') :</label>
                      <span style="position: absolute; left: 150px;">{{$project->country}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Customer/dashboard.Start Date') :</label>
                      <span style="position: absolute; left: 150px;">{{ date('M j, Y', strtotime($project->start_date)) }}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Customer/dashboard.End Date') :</label>
                      <span style="position: absolute; left: 150px;">{{ $project->end_date ? date('M j, Y', strtotime($project->end_date)) : 'Not Completed Yet' }}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Customer/dashboard.Locations') :</label>
                      <ul style="padding-left:150px; list-style-type:square">
                        @foreach ($project->locations as $location)
                          <li> <i>{{$location->name}}</i> </li>
                        @endforeach
                      </ul>
                    </div>

                    <div class="inline">
                      <label for="name">@lang('Customer/dashboard.Areas') :</label>
                      <ul style="padding-left:150px; list-style-type:square">
                        @foreach ($project->areas as $area)
                          <li> <i>{{$area->name}}</i> </li>
                        @endforeach
                      </ul>
                    </div>

                    <div class="inline">
                      <label for="name">@lang('Customer/dashboard.Tasks') :</label>
                      <ul style="padding-left:150px; list-style-type:square">
                        @foreach ($project->areas as $area)
                          @foreach($area->tasks as $task)
                            <li> <i>{{$task->name}}</i> </li>
                          @endforeach
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

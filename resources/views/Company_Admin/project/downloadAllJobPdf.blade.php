<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <title></title>
  </head>
  <body>
    <div class="">
      <h2>Advance Cleaning System</h2>
    </div>
    <div class="col-lg-12">
      <div class="panel panel-info">

        <div class="panel-heading">
          @lang('Company_Admin/dashboard.Project') @lang('Company_Admin/dashboard.Details')
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <!-- <div class="col-md-8 col-md-offset-4"> -->
          <div class="inline">
            <label for="name">@lang('Company_Admin/dashboard.Project')  @lang('Company_Admin/dashboard.Name') :</label>
            <span style="position: absolute; left: 150px;">{{$project->name}}</span>
          </div>
          <br>
          <div class="inline">
            <label for="name">@lang('Company_Admin/dashboard.Description') :</label>
            <span style="position: absolute; left: 150px;">{{$project->description}}</span>
          </div>
          <br>
          <div class="inline">
            <label for="name">@lang('Company_Admin/dashboard.Customer') :</label>
            <span style="position: absolute; left: 150px;">{{$project->customer->name}}</span>
          </div>
          <br>
          <div class="inline">
            <label for="name">@lang('Company_Admin/dashboard.Phone') :</label>
            <span style="position: absolute; left: 150px;">{{$project->phone}}</span>
          </div>
          <br>
          <div class="inline">
            <label for="name">@lang('Company_Admin/dashboard.Address') :</label>
            <span style="position: absolute; left: 150px;">{{$project->address}}</span>
          </div>
          <br>
          <div class="inline">
            <label for="name">@lang('Company_Admin/dashboard.Country') :</label>
            <span style="position: absolute; left: 150px;">{{$project->country}}</span>
          </div>
          <br>
          <div class="inline">
            <label for="name">@lang('Company_Admin/dashboard.Start Date') :</label>
            <span style="position: absolute; left: 150px;">{{ date('M j, Y', strtotime($project->start_date)) }}</span>
          </div>
          <br>
          <div class="inline">
            <label for="name">@lang('Company_Admin/dashboard.End Date') :</label>
            <span style="position: absolute; left: 150px;">{{ date('M j, Y', strtotime($project->end_date)) }}</span>
          </div>
          <br>

          <div class="inline">
            <label for="name"><strong>@lang('Company_Admin/dashboard.Locations') :</strong></label>
            <ul style="padding-left:150px; list-style-type:square">
              @foreach ($project->locations as $location)
              <li> <i>{{$location->name}}</i> </li>
              @endforeach
            </ul>
          </div>
          <div class="row">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <label for="name"><strong>@lang('Company_Admin/dashboard.Work Program') :</strong></label>
              </div>

              <div class="panel-body">
                @foreach($jobs as $key=>$job)
                  <h4>{{$job->floor->name}}</h4>
                  <table class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>@lang('Company_Admin/dashboard.Area')</th>
                        <th>@lang('Company_Admin/dashboard.Worker')</th>
                        <th>@lang('Company_Admin/dashboard.Location')</th>
                        <th>@lang('Company_Admin/dashboard.Element')</th>
                        <th>@lang('Company_Admin/dashboard.Task')</th>
                        <th>@lang('Company_Admin/dashboard.Type')</th>
                        <th>@lang('Company_Admin/dashboard.Mon')</th>
                        <th>@lang('Company_Admin/dashboard.Tue')</th>
                        <th>@lang('Company_Admin/dashboard.Wed')</th>
                        <th>@lang('Company_Admin/dashboard.Thur')</th>
                        <th>@lang('Company_Admin/dashboard.Fri')</th>
                        <th>@lang('Company_Admin/dashboard.Sat')</th>
                        <th>@lang('Company_Admin/dashboard.Sun')</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($job->days as $key => $day)
                      <tr>
                        <td>{{$day->area->name}}</td>
                        <td>{{$day->user->name}}</td>
                        <td>{{$day->location['name']}}</td>
                        <td>{{$day->element->name}}</td>
                        <td>{{$day->task->name}}</td>
                        <td>{{$day->type}}</td>
                        <td>{{($day->mon == "1") ? 'X':''}}</td>
                        <td>{{($day->tue == "1") ? 'X':''}}</td>
                        <td>{{($day->wed == "1") ? 'X':''}}</td>
                        <td>{{($day->thu == "1") ? 'X':''}}</td>
                        <td>{{($day->fri == "1") ? 'X':''}}</td>
                        <td>{{($day->sat == "1") ? 'X':''}}</td>
                        <td>{{($day->sun == "1") ? 'X':''}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                @endforeach
              </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </body>
</html>

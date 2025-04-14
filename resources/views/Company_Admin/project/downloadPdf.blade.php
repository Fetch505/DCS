<!DOCTYPE html>
<html lang="en" dir="ltr">
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
            <label for="name">@lang('Company_Admin/dashboard.Zip Code') :</label>
            <span style="position: absolute; left: 150px;">{{$project->zipcode}}</span>
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

          <div class="inline">
            <div class="" style="text-align:center;">
              <h2>@lang('Company_Admin/dashboard.Work Program')</h2>
            </div>
            <hr>
            <div class="">
              <label for="name"><strong>@lang('Company_Admin/dashboard.Floor') :</strong></label>
              <span style="position: absolute; left: 150px;">{{ $floor_name }}</span>
            </div>
            <div class="">
              <label for="name"><strong>@lang('Company_Admin/dashboard.Worker') :</strong></label>
              <span style="position: absolute; left: 150px;">{{ $days[0]->user->name }}</span>
            </div>
            <br>
            <div class="">
              <table class="table table-hover table-striped table-bordered">
                <thead>
                  <tr>
                    <th>@lang('Company_Admin/dashboard.Area')</th>
                    <th>@lang('Company_Admin/dashboard.Element')</th>
                    <th>@lang('Company_Admin/dashboard.Location')</th>
                    <th>@lang('Company_Admin/dashboard.Task')</th>
                    <th>@lang('Company_Admin/dashboard.Worker') @lang('Company_Admin/dashboard.Name')</th>
                    <th>@lang('Company_Admin/dashboard.Type')</th>
                    <th>mon</th>
                    <th>tue</th>
                    <th>wed</th>
                    <th>thu</th>
                    <th>fri</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($days as $key => $day)
                  <tr>
                    <td>{{$day->area->name}}</td>
                    <td >{{$day->element->name}}</td>
                    <td>{{$day->location['name']}}</td>
                    <td >{{$day->task->name}}</td>
                    <td >{{$day->user->name}}</td>
                    <td >{{$day->type}}</td>
                    <td >{{($day->mon == 1) ? 'X' : ''}}</td>
                    <td >{{($day->tue == 1) ? 'X' : ''}}</td>
                    <td >{{($day->wed == 1) ? 'X' : ''}}</td>
                    <td >{{($day->thu == 1) ? 'X' : ''}}</td>
                    <td >{{($day->fri == 1) ? 'X' : ''}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

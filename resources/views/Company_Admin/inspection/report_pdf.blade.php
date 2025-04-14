<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/fontawsome/font-awesome-4.7.0/css/font-awesome.min.css">
  <style type="text/css">
  .fa {
    display: inline;
    font-style: normal;
    font-variant: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 1;
    font-family: FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }
  </style>
    <title></title>
  </head>
  <body>
    <div class="">
      <h2>Advance Cleaning System</h2>
    </div>
    <div class="col-lg-12">

        <div class="row">
          <div class="col-sm-8">
            <h1>@lang('common.Inspection report')</h1>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">

            <div class="panel panel-info">
              <div class="panel-heading">
                @lang('common.Inspection report') PDF
              </div>

              <div class="panel-body">
                <div class="row">
                  <div style="padding-left: 15px; width: 50%; float:left;">
                    <label for="name">@lang('common.Project name') </label>
                    <span style="position: absolute; left: 150px;">: {{$inspectionReport->project->name}}</span>
                  </div>
                  <div style="width: 50%; float:right">
                    <label for="name">@lang('common.Inspector name') </label>
                    <span style="position: absolute; left: 150px;">: {{$inspectionReport->inspector->name}}</span>
                  </div>
                </div>
                <div class="row">
                  <div style="padding-left: 15px; width: 50%; float:left;">
                    <label for="name">@lang('common.Address') </label>
                    <span style="position: absolute; left: 150px;">: {{$inspectionReport->project->address}}</span>
                  </div>
                  <div style="width: 50%; float:right">
                    <label for="name">@lang('common.Inspection date') </label>
                    <span style="position: absolute; left: 150px;">: {{ date('M j, Y', strtotime($inspectionReport->created_at)) }}</span>
                  </div>

                </div>

                <br>
                <div class="row">
                  <div class="col col-md-12" v-if="tasks.length > 0">
                    <table  width="100%" id="table" class="table table-bordered table-striped table-hover">
                      <thead>
                        <tr>
                          <th width="35%">@lang('common.Task')</th>
                          <th width="35%">@lang('common.Worker')</th>
                          <th width="35%">@lang('common.Location')</th>
                          <th width="35%">@lang('common.Area')</th>
                          <th width="35%">@lang('common.Elements')</th>
                          <th width="35%">@lang('common.Frequency')</th>
                          <th width="10%">@lang('common.G')</th>
                          <th width="10%">@lang('common.S')</th>
                          <th width="10%">@lang('common.I')</th>
                          <th width="35%">Remarks</th>
                        </tr>
                      </thead>

                      <tbody>
                        @foreach($tasks as $key => $task)
                        <tr>
                          <td>{{ $task->name }}</td>
                          <td>{{ $task->worker_name }}</td>
                          <td>{{ $task->Location_name }}</td>
                          <td>{{ $task->area_name }}</td>
                          <td>{{ $task->element_name }}</td>
                          <td>{{ $task->frequency }}</td>
                          <td>@if ($task->ratings > 3.5)
                              <b>X</b>
                              @endif
                          </td>
                          <td>@if ($task->ratings < 3.5 && $task->ratings > 1.5)
                              <b>X</b>
                              @endif
                          </td>
                          <td>@if ($task->ratings < 1.5)
                              <b>X</b>
                              @endif
                          </td>
                          <td>{{ $task->remarks }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="">
                      <label for="name">@lang('common.G') :</label>
                      <span style="position: absolute; left: 50px;"> @lang('common.Good')</span>
                    </div>
                    <div class="">
                      <label for="name">@lang('common.S') :</label>
                      <span style="position: absolute; left: 50px;"> @lang('common.Sufficient')</span>
                    </div>
                    <div class="">
                      <label for="name">@lang('common.I') :</label>
                      <span style="position: absolute; left: 50px;"> @lang('common.Insufficient')</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </body>
</html>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link href="/public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <style media="screen">
      .page_break { page-break-before: always; }
    </style>

    <title></title>
  </head>
  <body>
    <div style="margin:0px 20px 0px 20px;">
      <br>
      <div class="row" style="background-color: #6f42c1; border-radius: 5px;">
        <div class="col-md-10">
          <h1 style=" color:white;"> <b>@lang('Company_Admin/dashboard.project_cost_estimate')</b> </h1>
        </div>
        <div class="col-md-2 ">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="panel panel-info">

          <div class="panel-heading">
            @lang('Company_Admin/dashboard.Project') @lang('Company_Admin/dashboard.Details')
          </div>
          <div class="panel-body">

            <div class="row">
              <div class="col-md-4 col-md-offset-1">
                <div class="inline">
                  <label for="name">@lang('Company_Admin/dashboard.Project')  @lang('Company_Admin/dashboard.Name') :</label>
                  <span style="position: absolute; left: 170px;">{{$projectCostEstimate->project_name}}</span>
                </div>
              </div>
              <div class="col-md-4 col-md-offset-1">
                <div class="inline">
                  <label for="name">@lang('Company_Admin/dashboard.Client') @lang('Company_Admin/dashboard.Name'):</label>
                  <span style="position: absolute; left: 170px;">{{$projectCostEstimate->client_name}}</span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 col-md-offset-1">
                <div class="inline">
                  <label for="name">@lang('Company_Admin/dashboard.Email') :</label>
                  <span style="position: absolute; left: 170px;">{{$projectCostEstimate->email}}</span>
                </div>
              </div>
              <div class="col-md-4 col-md-offset-1">
                <div class="inline">
                  <label for="name">@lang('Company_Admin/dashboard.Phone') :</label>
                  <span style="position: absolute; left: 170px;">{{$projectCostEstimate->phone}}</span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 col-md-offset-1">
                <div class="inline">
                  <label for="name">@lang('Company_Admin/dashboard.contact_person1') :</label>
                  <span style="position: absolute; left: 170px;">{{$projectCostEstimate->contact_person1}}</span>
                </div>

              </div>
              <div class="col-md-4 col-md-offset-1">
                <div class="inline">
                  <label for="name">@lang('Company_Admin/dashboard.contact_person2') :</label>
                  <span style="position: absolute; left: 170px;">{{$projectCostEstimate->contact_person2}}</span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 col-md-offset-1">
                <div class="inline">
                  <label for="name">@lang('Company_Admin/dashboard.Start Date') :</label>
                  <span style="position: absolute; left: 170px;">{{$projectCostEstimate->start_date}}</span>
                </div>
              </div>
              <div class="col-md-4 col-md-offset-1">
                <div class="inline">
                  <label for="name">@lang('Company_Admin/dashboard.End Date') :</label>
                  <span style="position: absolute; left: 170px;">{{$projectCostEstimate->end_date}}</span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 col-md-offset-1">
                <div class="inline">
                  <label for="name">@lang('Company_Admin/dashboard.Address') :</label>
                  <span style="position: absolute; left: 170px;">{{$projectCostEstimate->address}}</span>
                </div>
              </div>
              <div class="col-md-4 col-md-offset-1">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <div class="panel panel-info">
          <div class="panel-heading">
            @lang('Company_Admin/dashboard.Area') @lang('Company_Admin/dashboard.Estimate')
          </div>
          <div class="panel-body">

            <div class="form-group row">
              <div class="col-md-16 table-responsive">
                <table class="table table-hover table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>@lang('Company_Admin/dashboard.Floor') @lang('Company_Admin/dashboard.Type')</th>
                      <th>@lang('Company_Admin/dashboard.room_type')</th>
                      <th>@lang('Company_Admin/dashboard.Frequency')</th>
                      <th>@lang('Company_Admin/dashboard.Factor')</th>
                      <th>@lang('Company_Admin/dashboard.sq_meter_area_perHour')</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($areaEstimateTable as $key => $row)
                    <tr>
                      <td>{{$row->floor_type}}</td>
                      <td>{{$row->room_type}}</td>
                      <td>{{$row->frequency}}</td>
                      <td>{{$row->factor}}</td>
                      <td>{{$row->sq_meter_area_per_hour}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="page_break"></div>

      <div class="form-group row">
        <div class="panel panel-info">
          <div class="panel-heading">
            @lang('Company_Admin/dashboard.Space_state') @lang('Company_Admin/dashboard.Calculation')

          </div>
          <div class="panel-body">
            <div class="form-group row">
              <div class="col-md-6">
                <label for="floorType">@lang('Company_Admin/dashboard.Rate')</label>
                <input class="form-control" type="text" name="" value="{{$projectCostEstimate->rate}}" readonly>
              </div>
              <div class="col-md-6">
                <label for="floorType">@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.sq_meter_area_perHour')</label>
                <input class="form-control" type="text" name="" value="{{$projectCostEstimate->total_sq_meter_per_hour}}" readonly>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                <label for="floorType">@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Hours a Year')</label>
                <input class="form-control" type="text" name="" value="{{$projectCostEstimate->total_hours_a_year}}" readonly>
              </div>
              <div class="col-md-6">
                <label for="floorType">@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Hours a Day')</label>
                <input class="form-control" type="text" name="" value="{{$projectCostEstimate->total_hours_a_day}}" readonly>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                <label for="floorType">@lang('Company_Admin/dashboard.Contract Sum a Year')</label>
                <input class="form-control" type="text" name="" value="&#8364; {{$projectCostEstimate->contract_sum_a_year}}" readonly>
              </div>
              <div class="col-md-6">

              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-16">
                <table class="table table-bordered table-hovered table-striped">
                  <thead>
                    <tr>
                      <th>@lang('Company_Admin/dashboard.sq_meter')</th>
                      <th>@lang('Company_Admin/dashboard.Norm')</th>
                      <th>@lang('Company_Admin/dashboard.Hours per Turn')</th>
                      <th>@lang('Company_Admin/dashboard.Frequency')</th>
                      <th>@lang('Company_Admin/dashboard.Hours a Year')</th>
                      <th>@lang('Company_Admin/dashboard.Rate')</th>
                      <th>@lang('Company_Admin/dashboard.Amount')</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($spaceStateTable as $key => $row)
                    <tr>
                      <td>{{$row->sq_meter}}</td>
                      <td>{{$row->norm}}</td>
                      <td>{{$row->hours_per_turn}}</td>
                      <td>{{$row->frequency}}</td>
                      <td>{{$row->hours_a_year}}</td>
                      <td>{{$row->rate}}</td>
                      <td>&#8364;{{$row->amount}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

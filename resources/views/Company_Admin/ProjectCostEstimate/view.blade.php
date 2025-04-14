@extends('Company_Admin.layouts.main')

@section('outer_css')

<style src="{{asset('select2/dist/css/select2.min.css')}}"></style>
<link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
<link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<style>
  table{
    border: 1px solid;
  }
  tr{
    border: 1px solid;
  }
  td {
    border: 1px solid;
    text-align: center;
  }
  th {
    border: 1px solid;
    border-bottom: 1px solid;
  }
  thead {
    border: 1px solid;
  }
</style>
@endsection

@section('title', 'Dashboard')

  <div id="wrapper">
   <!-- <div id="app"> -->
    @section('content')
<div id="app">
    <br>

    <div class="row" style="background-color: #6f42c1; border-radius: 5px;">
        <div class="col-md-8">
          <h1 style=" color:white;"> <b>@lang('common.Project Calculation')</b> </h1>
        </div>
        <div class="col-md-4" style="float:right">
          <h1><a class="btn btn-success btn-md pull-right" href="{{route('projectcostestimate.index')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Back')</a></h1>

          <h1><a class="btn btn-danger btn-md pull-right" href="{{route('downloadEstimatePDF',$projectCostEstimate->id)}}" style="margin:0px 5px 0px 5px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download PDF</a></h1>
        </div>
      </div>
      <br>
    <div class="row">
        <!-- <div class="col-lg-12"> -->
          <!-- <a class="btn btn-primary btn-md pull-right" href="#"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Back')</a> -->
            <div class="panel panel-info">

                <div class="panel-heading">
                    @lang('Company_Admin/dashboard.Project') @lang('Company_Admin/dashboard.Details')

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                  <div class="row">
                    <div class="col-md-4 col-md-offset-1">
                      <div class="inline">
                        <label for="name">@lang('Company_Admin/dashboard.Project')  @lang('Company_Admin/dashboard.Name') :</label>
                        <span style="position: absolute; left: 150px;">{{$projectCostEstimate->project_name}}</span>
                      </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                      <div class="inline">
                        <label for="name">@lang('Company_Admin/dashboard.Client') @lang('Company_Admin/dashboard.Name'):</label>
                        <span style="position: absolute; left: 150px;">{{$projectCostEstimate->client_name}}</span>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4 col-md-offset-1">
                      <div class="inline">
                        <label for="name">@lang('Company_Admin/dashboard.Email') :</label>
                        <span style="position: absolute; left: 150px;">{{$projectCostEstimate->email}}</span>
                      </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                      <div class="inline">
                        <label for="name">@lang('Company_Admin/dashboard.Phone') :</label>
                        <span style="position: absolute; left: 150px;">{{$projectCostEstimate->phone}}</span>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4 col-md-offset-1">
                      <div class="inline">
                        <label for="name">@lang('Company_Admin/dashboard.contact_person1') :</label>
                        <span style="position: absolute; left: 150px;">{{$projectCostEstimate->contact_person1}}</span>
                      </div>

                    </div>
                    <div class="col-md-4 col-md-offset-1">
                      <div class="inline">
                        <label for="name">@lang('Company_Admin/dashboard.contact_person2') :</label>
                        <span style="position: absolute; left: 150px;">{{$projectCostEstimate->contact_person2}}</span>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4 col-md-offset-1">
                      <div class="inline">
                        <label for="name">@lang('Company_Admin/dashboard.Start Date') :</label>
                        <span style="position: absolute; left: 150px;">{{ $projectCostEstimate->start_date}}</span>
                      </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                      <div class="inline">
                        <label for="name">@lang('Company_Admin/dashboard.End Date') :</label>
                        <span style="position: absolute; left: 150px;">{{ $projectCostEstimate->end_date}}</span>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4 col-md-offset-1">
                      <div class="inline">
                        <label for="name">@lang('Company_Admin/dashboard.Address') :</label>
                        <span style="position: absolute; left: 150px;">{{$projectCostEstimate->address}}</span>
                      </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">

                    </div>
                  </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        <!-- </div> -->
        <!-- /.col-lg-12 -->
    </div>


    <div class="form-group row">
      <div class="panel panel-info">
        <div class="panel-heading">
          @lang('Company_Admin/dashboard.Area') @lang('Company_Admin/dashboard.Estimate')
        </div>
        <div class="panel-body">

          <div class="form-group row">
            <div class="col-md-16 table-responsive">
              <table class="table table-bordered table-hovered table-striped">
                <thead>
                  <th>@lang('Company_Admin/dashboard.Floor') @lang('Company_Admin/dashboard.Type')</th>
                  <th>@lang('Company_Admin/dashboard.room_type')</th>
                  <th>@lang('Company_Admin/dashboard.Frequency')</th>
                  <th>@lang('Company_Admin/dashboard.Factor')</th>
                  <th>@lang('Company_Admin/dashboard.sq_meter_area_perHour')</th>
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

    <!-- ////////////////// -->

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
              <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-euro"></i></span><input class="form-control" type="text" name="" value="{{$projectCostEstimate->contract_sum_a_year}}" readonly>
              </div>

            </div>
            <div class="col-md-6">

            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-16 table-responsive">
              <table class="table table-bordered table-hovered table-striped">
                <thead>
                  <th>@lang('Company_Admin/dashboard.sq_meter')</th>
                  <th>@lang('Company_Admin/dashboard.Norm')</th>
                  <th>@lang('Company_Admin/dashboard.Hours per Turn')</th>
                  <th>@lang('Company_Admin/dashboard.Frequency')</th>
                  <th>@lang('Company_Admin/dashboard.Hours a Year')</th>
                  <th>@lang('Company_Admin/dashboard.Rate')</th>
                  <th>@lang('Company_Admin/dashboard.Amount')</th>
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
                    <td><i class="fa fa-euro"></i> {{$row->amount}}</td>
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
 <!-- </div> -->
<!-- vue ends here -->
    @endsection
</div>

  @section('outer_script')
  <script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
  @endsection


<!-- Content Header (Page header) -->

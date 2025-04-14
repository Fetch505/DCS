@extends('Company_Admin.layouts.main')

@section('outer_css')

<style src="{{asset('public/select2/dist/css/select2.min.css')}}"></style>
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
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Inspection report')</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <a class="btn btn-md btn-danger pull-right" href="{{route('inspection.download',$inspectionReport->id)}}" style="margin:5px;" name="button"><i class="far fa-file-pdf"></i> @lang('Company_Admin/dashboard.Download') PDF</a>
        <a class="btn btn-primary btn-md pull-right" style="margin:5px;" href="{{route('inspection.index')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Back')</a>
        <div class="panel panel-info">
          <div class="panel-heading">
            @lang('common.Inspection report') PDF
          </div>

          <div class="panel-body">
            <div class="row">
              <div class="col col-md-6">
                <label for="name">@lang('common.Project name') </label>
                <span style="position: absolute; left: 150px;">: {{$inspectionReport->project->name}}</span>
              </div>
              <div class="col col-md-6">
                <label for="name">@lang('common.Inspector name') </label>
                <span style="position: absolute; left: 150px;">: {{$inspectionReport->inspector->name}}</span>
              </div>
            </div>
            <div class="row">
              <div class="col col-md-6">
                <label for="name">@lang('common.Address') </label>
                <span style="position: absolute; left: 150px;">: {{$inspectionReport->project->address}}</span>
              </div>
              <div class="col col-md-6">
                <label for="name">@lang('common.Inspection date') </label>
                <span style="position: absolute; left: 150px;">: {{ date('M j, Y', strtotime($inspectionReport->created_at)) }}</span>
              </div>
            </div>

            <br>

            <!-- <div class="row">
              <div class="col col-md-12">
                <div class="panel panel-yellow">
                  <div class="panel-heading">
                    @lang('common.Comments')
                  </div>

                  <div class="panel-body">
                    <p>{{ $inspectionReport->review }}</p>
                  </div>
                </div>
              </div>
            </div> -->


            <br>
            <div class="row">
              <div class="col col-md-12">
                <table  width="100%" id="table" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th width="35%">Worker</th>
                      <th width="35%">Location</th>
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
                    @foreach($tasks as $key => $timecard)

                    <tr>
                     <td>{{$timecard->worker_name}}</td>
                     <td>{{$timecard->Location_name}}</td>
                      <td>{{ $timecard->area_name }}</td>
                      <td>{{ $timecard->element_name }}</td>
                      <td>{{ $timecard->frequency }}</td>
                      <td>@if ($timecard->ratings > 4)
                          <i class="far fa-check-square"></i>
                          @endif
                      </td>
                      <td>@if ($timecard->ratings <= 4 && $timecard->ratings > 3)
                          <i class="far fa-check-square"></i>
                          @endif
                      </td>
                      <td>@if ($timecard->ratings <= 3)
                          <i class="far fa-check-square"></i>
                          @endif
                      </td>
                      <td>{{ $timecard->remarks }}</td>
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

  @endsection
</div>
  @section('outer_script')
  <script src="{{asset('public/select2/dist/js/select2.min.js')}}"></script>
  <script src="{{asset('public/js/lodash.min.js')}}"></script>
  <script src="{{asset('public/js/axios.min.js')}}"></script>
  <script src="{{asset('public/js/vue.min.js')}}"></script>
  <script src="{{asset('public/js/vue-select-latest.js')}}"></script>

  @endsection

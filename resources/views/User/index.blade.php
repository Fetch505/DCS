@extends('User.layouts.main')

@section('title', 'Dashboard')

@section('outer_css')
<style media="screen">
[v-cloak] {
  display: none;
}

table{
  table-layout: fixed;
  width: 100px;
}
</style>
@endsection


<!-- <script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script> -->
<div id="wrapper">
  @section('content')
  <div class="row">
    <div class="col-sm-8">
      <h1>@lang('Worker/dashboard.Today') @lang('Worker/dashboard.Jobs')</h1>
    </div>
  </div>

  <div class="row" id="app" v-cloak>
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <b>@lang('Worker/dashboard.Daily') @lang('Worker/dashboard.Jobs')</b>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <table width="100%" id="table" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>Sr #</th>
                <th>@lang('Worker/dashboard.Project')</th>
                <th>@lang('Worker/dashboard.Task')</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(dailyJob, index) in dailyJobs">
                <td>@{{++index}}</td>
                <td>@{{dailyJob['project_name']}}</td>
                <td>@{{dailyJob['task_name']}}</td>
                <td style="text-align:center;">
                  <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#viewDetails" @click="showDetails(dailyJob)">@lang('Worker/dashboard.View') @lang('Worker/dashboard.Details')</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <b>@lang('Worker/dashboard.Weekly') @lang('Worker/dashboard.Jobs')</b>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <table width="100%" id="table" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>Sr #</th>
                <th>@lang('Worker/dashboard.Project')</th>
                <th>@lang('Worker/dashboard.Task')</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(weeklyJob, index) in weeklyJobs">
                <td>@{{++index}}</td>
                <td>@{{weeklyJob['project_name']}}</td>
                <td>@{{weeklyJob['task_name']}}</td>
                <td style="text-align:center;">
                  <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#viewDetails" @click="showDetails(weeklyJob)">@lang('Worker/dashboard.View') @lang('Worker/dashboard.Details')</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div id="viewDetails" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Job Detail</h4>
          </div>
          <div class="modal-body">

            <div class="row">
              <div class="col-md-4">
                <label for="">@lang('Worker/dashboard.Customer')</label>
              </div>
              <div class="col-md-6">
                @{{jobDetail['customer_name']}}
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <label for="">@lang('Worker/dashboard.Project') @lang('Worker/dashboard.Name')</label>
              </div>
              <div class="col-md-6">
                @{{jobDetail['project_name']}}
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <label for="">@lang('Worker/dashboard.Project') @lang('Worker/dashboard.Address')</label>
              </div>
              <div class="col-md-6">
                @{{jobDetail['project_address']}}
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <label for="">@lang('Worker/dashboard.Floor')</label>
              </div>
              <div class="col-md-6">
                @{{jobDetail['floor_name']}}
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <label for="">@lang('Worker/dashboard.Area')</label>
              </div>
              <div class="col-md-6">
                @{{jobDetail['area_name']}}
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <label for="">@lang('Worker/dashboard.Task')</label>
              </div>
              <div class="col-md-6">
                @{{jobDetail['task_name']}}
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <label for="">@lang('Worker/dashboard.Notes')</label>
              </div>
              <div class="col-md-6">
                @{{jobDetail['note']}}
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <label for="">@lang('Worker/dashboard.Start Time')</label>
              </div>
              <div class="col-md-6">
                @{{jobDetail['start_time']}}
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <label for="">@lang('Worker/dashboard.End Time')</label>
              </div>
              <div class="col-md-6">
                @{{jobDetail['end_time']}}
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <label for="">@lang('Worker/dashboard.Total Time')</label>
              </div>
              <div class="col-md-6">
                @{{jobDetail['total_time']}}
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <template v-if="jobStatusRequest">
              <button class="btn btn-success" name="button"  @click.prevent="startJob" :disabled="!jobDetail.startJob"
               data-dismiss="modal">@lang('Worker/dashboard.Start') @lang('Worker/dashboard.Job')</button >
              <button class="btn btn-danger" @click.prevent="endJob" :disabled="!jobDetail.finishJob" name="button" data-dismiss="modal">@lang('Worker/dashboard.End') @lang('Worker/dashboard.Job')</button>
            </template>


            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
  </div>
  @endsection
</div>
@section('outer_script')
<script type="text/javascript">
let APP_URL = {!! json_encode(url('/').'/') !!}
</script>
<script src="{{asset('js/lodash.min.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script src="{{asset('js/vue.min.js')}}"></script>
<script src="https://unpkg.com/vue-swal"></script>
<script src="{{asset('js/workerIndex.js')}}"></script>
@endsection

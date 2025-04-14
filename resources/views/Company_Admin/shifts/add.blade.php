@extends('Company_Admin.layouts.main')

@section('outer_css')
<link href="{{asset('public/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
<style>
    [v-cloak] {
      display: none;
    }
</style>
@endsection

@section('title', 'Dashboard')

<div id="wrapper">
  @section('content')
  <div id="app" v-cloak>
    <input type="hidden" ref="language" value="{{App::getLocale()}}">
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Shift Management')</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            @lang('common.Add new shift')
          </div>
          <div class="panel-body">
            <div class="">

              <div class="form-group row">
                <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Title'):*</label>
                <div class="col-md-8">
                  <input class="form-control" type="text" v-model:value="title">
                  <span style="color:red;" v-if="errors.title">@{{errors.title[0]}}</span>
                </div>
              </div>

              <div class="form-group row">
                <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.Description'):</label>
                <div class="col-md-8">
                  <input class="form-control" type="text" v-model:value="description">
                  <span style="color:red;" v-if="errors.description">@{{errors.description[0]}}</span>
                </div>
              </div>

              <div class="form-group row">
                <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.Start Time'):*</label>
                <div class="col-md-3">
                  <input class="form-control" type="time" v-model:value="time_starts">
                  <span style="color:red;" v-if="errors.time_starts" class="error">@{{ errors.time_starts[0] }}</span>
                </div>
                <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.End Time'):*</label>
                <div class="col-md-3">
                  <input class="form-control" type="time" v-model:value="time_ends">
                  <span style="color:red;" v-if="errors.time_ends" class="error">@{{ errors.time_ends[0] }}</span>
                </div>
              </div>

              <div class="form-group row">
                  <label  class="col-md-2" for="">Total Time:</label>
                  <div class="col-md-3">
                      <input class="form-control" type="number" v-model:value="total_time" min="0">
                      <span style="color:red;" v-if="errors.total_time">@{{errors.total_time[0]}}</span>
                  </div>
                <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.Time cushion in munutes'):</label>
                <div class="col-md-3">
                  <input class="form-control" type="number" v-model:value="time_cushion" min="0">
                  <span style="color:red;" v-if="errors.time_cushion">@{{errors.time_cushion[0]}}</span>
                </div>
              </div>

              <br />
              <br />

              <div class="inline pull-right">
                <button type="button" @click.prevent="saveDetails" class="btn btn-success">@lang('Company_Admin/dashboard.Add')</button>
                <a href="{{ route('shift.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
              </div>
            </div>
          </div>
      </div>
  </div>
</div>
@endsection
</div>

  @section('outer_script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <script src="{{asset('public/js/vue.min.js')}}"></script>
  <script src="{{asset('public/js/test/dist/vue-phone-number-input.umd.min.js')}}" charset="utf-8"></script>
  <script type="text/javascript">

  </script>
  <script src="{{asset('public/select2/dist/js/select2.min.js')}}"></script>
  <script src="{{asset('public/js/lodash.min.js')}}"></script>
  <script src="{{asset('public/js/axios.min.js')}}"></script>
  <script src="{{asset('public/js/vue-select-latest.js')}}"></script>
  <script src="{{asset('public/js/vue.min.js')}}"></script>

  <script src="https://unpkg.com/vue-swal"></script>

  <script src="{{asset('public/js/Shift/add.js')}}"></script>
  @endsection

<!-- Content Header (Page header) -->

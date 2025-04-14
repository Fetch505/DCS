@extends('Company_Admin.layouts.main')

@section('outer_css')
  <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('title', 'Dashboard')

<div id="wrapper">
  @section('content')
  <div id="app" v-cloak>
    @if ($exception)
    <div class="alert alert-danger">
    @lang( "An error occurred. Please try again later." )
    </div>
    @endif

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
            @lang('common.Update shift')
          </div>
          <div class="panel-body">
            {{ Form::model($shift,['route' => ['shift.update',$shift->id], 'method' => 'PUT' ,'data-parsley-validate' => '']) }}
              <input type="hidden" id="language" value="{{App::getLocale()}}">
              <div class="form-group row">

              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Title'):*</label>
                <div class="col-md-8">
                  {{ Form::text('title',($shift->title)? $shift->title :  null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                </div>
              </div>

              <div class="form-group row">
                <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.Description'):</label>
                <div class="col-md-8">
                  {{ Form::text('description', ($shift->description)? $shift->description : null, ['class' => 'form-control', 'maxlength' => '255']) }}
                </div>
              </div>

              <div class="form-group row">
                <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.Start Time'):*</label>
                <div class="col-md-3">
                  {{ Form::time('time_starts',($shift->time_starts)? $shift->time_starts :  null, ['class' => 'form-control', 'required' => '']) }}
                </div>
                <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.End Time'):*</label>
                <div class="col-md-3">
                  {{ Form::time('time_ends',($shift->time_ends)? $shift->time_ends :  null, ['class' => 'form-control', 'required' => '']) }}
                </div>
              </div>

              <div class="form-group row">
                  <label  class="col-md-2" for="">Total Time:*</label>
                  <div class="col-md-3">
                      {{ Form::number('total_time',($shift->total_time)? $shift->total_time :  null, ['class' => 'form-control', 'required' => '']) }}
                  </div>
                <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.Time cushion in munutes'):*</label>
                <div class="col-md-3">
                  {{ Form::number('time_cushion',($shift->time_cushion)? $shift->time_cushion :  null, ['class' => 'form-control', 'required' => '']) }}
                </div>
              </div>

              <br />

              <div class="inline pull-right">
                <button type="submit" class="btn btn-success">@lang('Company_Admin/dashboard.Save')</button>
                <a href="{{ route('shift.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
              </div>
              {{ Form::close() }}

            </div>
          </div>
      </div>
  </div>
</div>
@endsection
</div>

  @section('outer_script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <script src="{{asset('js/vue.min.js')}}"></script>
  <script src="{{asset('js/test/dist/vue-phone-number-input.umd.min.js')}}" charset="utf-8"></script>
  <script type="text/javascript">

  </script>
  <script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
  <script src="{{asset('js/lodash.min.js')}}"></script>
  <script src="{{asset('js/axios.min.js')}}"></script>
  <script src="{{asset('js/vue-select-latest.js')}}"></script>
  <script src="{{asset('js/vue.min.js')}}"></script>

  <script src="https://unpkg.com/vue-swal"></script>

  <script src="{{asset('js/Shift/edit.js')}}"></script>
  @endsection

<!-- Content Header (Page header) -->

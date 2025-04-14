@extends('Company_Admin.layouts.main')

@section('outer_css')
  <link href="{{asset('public/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('title', 'Dashboard')

<div id="wrapper">
  @section('content')
  <div class="row">
    <div class="col-sm-8">
      <h1>@lang('common.Areas Management')</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          @lang('common.Add new area')
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <div class="">
            {{ Form::open(['route' => 'area.store', 'method' => 'POST', 'data-parsley-validate' => '']) }}

            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Name'):*</label>
              <div class="col-md-8">
                {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
              </div>
            </div>

          <div class="inline pull-right">
            <button type="submit" class="btn btn-success">@lang('Company_Admin/dashboard.Add')</button>
            <a href="{{ route('area.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
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
  <script src="{{asset('public/select2/dist/js/select2.min.js')}}"></script>
  <script>
        $('#multi-select').select2();
  </script>
  @endsection

<!-- Content Header (Page header) -->

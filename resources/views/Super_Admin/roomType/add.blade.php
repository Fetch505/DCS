@extends('Super_Admin.layouts.admin')

@section('outer_css')
  <link href="{{asset('public/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('title', 'Dashboard')

@section('content')
  <section class="content">
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Room Types Management')</h1>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  @lang('common.Add new room type')
                </div>
                <div class="panel-body">
                  <div class="">
                    {{ Form::open(['route' => 'roomType.store', 'method' => 'POST', 'data-parsley-validate' => '']) }}

                      <div class="form-group row">
                        <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Room') @lang('Company_Admin/dashboard.Type') @lang('Company_Admin/dashboard.Name'):*</label>
                          <div class="col-md-8">
                            {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Floors') @lang('Company_Admin/dashboard.Type'):*</label>
                            <div class="col-md-8">
                              {{ Form::select('floor', $floors, null, ['class' => 'js-example-basic-single form-control','id' => 'multi-select','placeholder' => 'Select Floor...']) }}
                            </div>
                          </div>

                      <div class="form-group row">
                        <label class="col-md-2" for="">@lang('Company_Admin/dashboard.stnd_frequency'):*</label>
                          <div class="col-md-8">
                            {{ Form::number('stnd_frequency', null, ['class' => 'form-control', 'required' => '', 'min' => '0', 'maxlength' => '255']) }}
                          </div>
                        </div>

                      <div class="form-group row">
                        <label class="col-md-2" for="">@lang('Company_Admin/dashboard.stnd_sq_meter_area_perHour'):*</label>
                          <div class="col-md-8">
                            {{ Form::number('stnd_sq_meter_area', null, ['class' => 'form-control', 'required' => '', 'min' => '0', 'maxlength' => '255']) }}
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2" for="">@lang('Company_Admin/dashboard.comment'):*</label>
                            <div class="col-md-8">
                              {{ Form::text('comments', null, ['class' => 'form-control', 'maxlength' => '255']) }}
                            </div>
                          </div>

                        <div class="inline pull-right">
                          <button type="submit" class="btn btn-success">@lang('Company_Admin/dashboard.Add')</button>
                          <a href="{{ route('roomType.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
                        </div>
                    {{ Form::close() }}
                  </div>
                </div>
            </div>
        </div>
    </div>
 </section>
@endsection

  @section('outer_script')
  <script src="{{asset('public/select2/dist/js/select2.min.js')}}"></script>
  <script>
        $('#multi-select').select2();
  </script>
  @endsection

<!-- Content Header (Page header) -->

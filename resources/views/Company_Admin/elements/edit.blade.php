@extends('Company_Admin.layouts.main')

@section('outer_css')
  <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('title', 'Dashboard')

@section('content')
  <section class="content">
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Elements Management')</h1>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  @lang('common.Edit element')
                </div>
                <div class="panel-body">
                  {{ Form::model($element,['route' => ['element.update',$element->id], 'method' => 'PUT', 'data-parsley-validate' => '']) }}

                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Name'):*</label>
                        <div class="col-md-8">
                            {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                        </div>
                    </div>

                    <!--div class="form-group row">
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Name'):*</label>
                        <div class="col-md-8">
                            {{ Form::text('name_eng', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                            {{ __('(English)') }}
                        </div>
                    </div-->

                    <div class="inline pull-right">
                        <button type="submit" class="btn btn-success">@lang('Company_Admin/dashboard.Save')</button>
                        <a href="{{ route('element.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
                    </div>
                  {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection

  @section('outer_script')
  <script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
  <script>
        $('#multi-select').select2();
  </script>
  @endsection
<!-- Content Header (Page header) -->

@extends('Company_Admin.layouts.main')

@section('outer_css')
  <link href="{{asset('public/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('title', 'Dashboard')

  <div id="wrapper">
    @section('content')
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('Company_Admin/dashboard.Material') @lang('Company_Admin/dashboard.Types') @lang('Company_Admin/dashboard.Management')</h1>
      </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('Company_Admin/dashboard.Edit') @lang('Company_Admin/dashboard.Material') @lang('Company_Admin/dashboard.Type')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  {{ Form::model($materialType,['route' => ['materialType.update',$materialType->id], 'method' => 'PUT', 'data-parsley-validate' => '']) }}
                    
                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('common.Category'):*</label>
                      <div class="col-md-8">
                        {{ Form::select('material_category_id', $materialCategories, $materialType->material_category_id ? $materialType->material_category_id : null, ['class' => 'form-control','id' => 'material_category_id', 'placeholder' => 'Select Category'])}}
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2" for=""> @lang('Company_Admin/dashboard.Name'):*</label>
                      <!-- {{ Form::label('name', 'Material Name:*', ['class' => 'col-md-2 col-form-label']) }} -->
                        <div class="col-md-8">
                            {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                        </div>
                    </div>

                    <div class="inline pull-right">
                        <button type="submit" class="btn btn-success">@lang('Company_Admin/dashboard.Save')</button>
                        <a href="{{ route('materialType.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
                    </div>
                  {{ Form::close() }}
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    @endsection
  </div>

  @section('outer_script')
  <script src="{{asset('public/select2/dist/js/select2.min.js')}}"></script>
  <script>
    $(document).ready(function() {
        $('#multi-select').select2();
    });
  </script>
  @endsection
<!-- Content Header (Page header) -->

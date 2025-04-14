@extends('Company_Admin.layouts.main')

@section('outer_css')
  <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('title', 'Dashboard')

  <div id="wrapper">
    @section('content')
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('Company_Admin/dashboard.Material') @lang('common.Category') @lang('Company_Admin/dashboard.Management')</h1>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('Company_Admin/dashboard.Add') @lang('Company_Admin/dashboard.New') @lang('Company_Admin/dashboard.Material') @lang('common.Category')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <div class="">
                    {{ Form::open(['route' => 'materialCategory.store', 'method' => 'POST', 'data-parsley-validate' => '']) }}

                      <div class="form-group row">
                        <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Name'):*</label>
                        <div class="col-md-8">
                          {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                        </div>
                      </div>

                      <div class="form-group row" id="ConsumableField">
                        <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Consumable'):</label>
                        <div class="col-md-8">
                            {{ Form::hidden('consumable', 0) }}
                            {{ Form::checkbox('consumable', 1, true, ['id' => 'consumableCheckbox']) }}
                        </div>
                      </div>

                      <div class="form-group row" id="usageLimitField" style="display: none;">
                        <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Usage Limit'):</label>
                        <div class="col-md-8">
                            {{ Form::hidden('has_usage_limit', 0) }}
                            {{ Form::checkbox('has_usage_limit', 1, false, [ 'id' => 'has_usage_limit']) }}
                        </div>
                      </div>
                      
                      <div class="inline pull-right">
                        <button type="submit" class="btn btn-success">@lang('Company_Admin/dashboard.Add')</button>
                        <a href="{{ route('materialCategory.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
                      </div>

                    {{ Form::close() }}
                  </div>

                    <!-- /.table-responsive -->
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
  <script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
  <script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
  </script>
  <script>
    // JavaScript to handle checkbox change event
    document.getElementById('consumableCheckbox').addEventListener('change', function() {
      var usageLimitField = document.getElementById('usageLimitField');
      if (this.checked) {
          usageLimitField.style.display = 'none';
          document.getElementById('has_usage_limit').checked = false;
      } else {
          usageLimitField.style.display = 'block';
      }
    });
  </script>
  @endsection

<!-- Content Header (Page header) -->

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
                    @lang('Company_Admin/dashboard.Add') @lang('Company_Admin/dashboard.New') @lang('Company_Admin/dashboard.Material') @lang('Company_Admin/dashboard.Type')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <div class="">
                    {{ Form::open(['route' => 'materialType.store', 'method' => 'POST', 'data-parsley-validate' => '']) }}

                      <div class="form-group row">
                        <label class="col-md-2" for="">@lang('common.Category'):*</label>
                        <div class="col-md-8">
                          <select class="form-control js-example-basic-single" name="material_category_id">
                            @foreach ($materialCategories as $key => $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Name'):*</label>
                        <!-- {{ Form::label('name', 'Material Name:*', ['class' => 'col-md-2 col-form-label']) }} -->
                        <div class="col-md-8">
                          {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                        </div>
                      </div>

                      <div class="inline pull-right">
                        <button type="submit" class="btn btn-success">@lang('Company_Admin/dashboard.Add')</button>
                        <a href="{{ route('materialType.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
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
  <script src="{{asset('public/select2/dist/js/select2.min.js')}}"></script>
  <script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
  </script>
  @endsection

<!-- Content Header (Page header) -->

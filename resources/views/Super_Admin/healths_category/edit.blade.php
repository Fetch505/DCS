@extends('Super_Admin.layouts.admin')

@section('outer_css')
  <link href="{{asset('multiple-select/multiple-select.css')}}" rel="stylesheet"/>
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
        <h1>@lang('common.Health Category Management')</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            @lang('common.Update')
          </div>
          <div class="panel-body">
            {{ Form::model($category,['route' => ['healthCategory.update',$category->id], 'method' => 'PUT' ,'data-parsley-validate' => '']) }}
              <input type="hidden" id="language" value="{{App::getLocale()}}">
              <div class="form-group row">
                
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Name'):*</label>
                <div class="col-md-8">
                  {{ Form::text('name',($category->name)? $category->name :  'null', ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                </div>
              </div>
              
              <div class="inline pull-right">
                <button type="submit" class="btn btn-success">@lang('Company_Admin/dashboard.Save')</button>
                <a href="{{ route('healthCategory.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
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

  <script src="{{asset('js/Method/edit.js')}}"></script>
  @endsection

<!-- Content Header (Page header) -->

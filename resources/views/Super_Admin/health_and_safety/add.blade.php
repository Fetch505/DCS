@extends('Super_Admin.layouts.admin')

@section('outer_css')
  <link href="{{asset('public/multiple-select/multiple-select.css')}}" rel="stylesheet"/>
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
        <h1>@lang('common.Health And Safety Management')</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            @lang('Company_Admin/dashboard.Add New')
          </div>
          <div class="panel-body">
            <div class="">

              <div class="form-group row"  id="category">
                <label class="col-md-2" for="">@lang('common.Category'):</label>
                <div class="col-md-8">
                  <select class="form-control" name="role" v-model="category_id" id="multi-select2">
                    <option value="" disabled>@lang('common.Select Category')</option>
                    @foreach($category as $key => $category)
                      <option value="{{$key}}">{{$category}}</option>
                    @endforeach
                  </select>
                  <span style="color:red;" v-if="errors.category_id">@{{errors.category_id}}</span>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Title'):*</label>
                <div class="col-md-8">
                  <input class="form-control" type="text" v-model:value="title">
                  <span style="color:red;" v-if="errors.title">@{{errors.title}}</span>
                </div>
              </div>

              <div class="form-group row">
                <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.Description'):*</label>
                <div class="col-md-8">
                  <input class="form-control" type="texgt" v-model:value="description">
                  <span style="color:red;" v-if="errors.description">@{{errors.description}}</span>
                </div>
              </div>

              <div class="form-group row">
                <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.Select') @lang('Company_Admin/dashboard.Video'):*</label>
                <div class="col-md-4">
                  <input type="file" ref="file" @change="handleFileInputChange">
                  <span style="color:red;" v-if="errors.file" class="error">@{{ errors.file }}</span>
                </div>
              </div>
              <br />
              <br />

              <div class="inline pull-right">
                <button type="button" @click.prevent="uploadVideo" class="btn btn-success">@lang('Company_Admin/dashboard.Add')</button>
                <a href="{{ route('health.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
              </div>
            </div>
          </div> 
          <!-- panel -->
        </div>
      </div>
    </div>
  </div>
@endsection
</div>

  @section('outer_script')
  <script src="{{asset('public/js/vue.min.js')}}"></script>
  <script src="{{asset('public/js/test/dist/vue-phone-number-input.umd.min.js')}}" charset="utf-8"></script>
  <script src="{{asset('public/select2/dist/js/select2.min.js')}}"></script>
  <script src="{{asset('public/js/lodash.min.js')}}"></script>
  <script src="{{asset('public/js/axios.min.js')}}"></script>
  <script src="{{asset('public/js/vue-select-latest.js')}}"></script>
  <script src="{{asset('public/js/vue.min.js')}}"></script>

  <script src="https://unpkg.com/vue-swal"></script>

  <script src="{{asset('public/js/Health/add.js')}}"></script>
  @endsection

<!-- Content Header (Page header) -->

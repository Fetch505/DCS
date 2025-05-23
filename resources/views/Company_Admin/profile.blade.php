@extends('Company_Admin.layouts.main')

@section('outer_css')
<link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
<link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" type="text/css" />
<style>
  [v-cloak] {
    display: none;
  }
</style>
@endsection

@section('title', 'Dashboard')

<div id="wrapper">
  @section('content')
  <div class="row">
    <div class="col-sm-8">
      <h1>@lang('Company_Admin/dashboard.Company') @lang('Company_Admin/dashboard.Profile')</h1>
    </div>
  </div>

  <div class="row" id="app">
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  @lang('Company_Admin/dashboard.Company') @lang('Company_Admin/dashboard.Details')
              </div>

              <div class="panel-body">
                <div class="">
                    <!--div class="form-group row">
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Company') @lang('Company_Admin/dashboard.Name'):*</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="name" v-model:value="company" readonly>
                        </div>
                      </div-->

                      <div class="form-group row">
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Company'):*</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="name" v-model:value="name" readonly>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.Email'):*</label>
                        <div class="col-md-8">
                          <input type="email" class="form-control" name="email" v-model:value="email">
                          <span v-show='emailError' style="color:red;">@lang('Company_Admin/dashboard.Invalid Email')</span>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.New Password'):*</label>
                        <div class="col-md-8">
                          <div class="form-group input-group">
                            <input :type="passwordField" class="form-control" name="country" v-model:value="pass">
                            <span class="input-group-addon"> <button type="button" name="button" @click.prevent="chageVisibility"><i :class="eyeIcon"></i></button></span>
                          </div>
                          <p v-if='pass.length < 6' style="color:red;">@lang('Company_Admin/dashboard.At least 6 characters long')</p>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Language'):*</label>
                        <div class="col-md-8">
                          <select name="language" class="form-control" v-model:value="language">
                            <option value="nl">Dutch</option>
                            <option value="en">English</option>
                          </select>
                        </div>
                      </div>

                      <div class="inline pull-right">
                        <button type="button" class="btn btn-success" @click.prevent="updateDetails">@lang('Company_Admin/dashboard.Update')</button>
                        <a href="{{ route('com_admin.dashboard') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
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
  <script src="{{asset('js/vue.min.js')}}"></script>
  <script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
  <script src="{{asset('js/lodash.min.js')}}"></script>
  <script src="{{asset('js/axios.min.js')}}"></script>
  <script src="{{asset('js/vue-select-latest.js')}}"></script>
  <script src="https://unpkg.com/vue-swal"></script>

  <script src="{{asset('js/Profiles/companyProfile.js')}}"></script>
  @endsection

<!-- Content Header (Page header) -->

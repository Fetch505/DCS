@extends('Company_Admin.layouts.main')

@section('outer_css')
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
    <div class="row" >
      <div class="col-sm-8">
        <h1>@lang('common.Customers Management')</h1>
      </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('common.Add new customer')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <div class="">

                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Name'):*</label>
                        <div class="col-md-8">
                          <input class="form-control" type="text" v-model:value="name">
                          <span style="color:red;" v-if="errors.name">@{{errors.name[0]}}</span>
                        </div>
                      </div>

                        <div class="form-group row">
                          <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.Email'):*</label>
                          <div class="col-md-8">
                            <input class="form-control" type="email" v-model:value="email">
                            <span style="color:red;" v-if="errors.email">@{{errors.email[0]}}</span>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2" for="">@lang('Company_Admin/dashboard.contact_person1'):*</label>
                          <div class="col-md-8">
                            <input class="form-control" type="text" v-model:value="contact_person1">
                            <span style="color:red;" v-if="errors.contact_person1">@{{errors.contact_person1[0]}}</span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2" for="">@lang('Company_Admin/dashboard.contact_person2'):*</label>
                          <div class="col-md-8">
                            <input class="form-control" type="text" v-model:value="contact_person2">
                            <span style="color:red;" v-if="errors.contact_person2">@{{errors.contact_person2[0]}}</span>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.Phone'):*</label>
                          <div class="col-md-8">
                            <vue-phone-number-input default-country-code="NL" @update="onUpdate" v-model="phone"/>
                            <span style="color:red;" v-if="errors.phone">@{{errors.phone[0]}}</span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.Country'):*</label>
                          <div class="col-md-8">
                            <input class="form-control" disabled type="text" v-model:value="country">
                            <span style="color:red;" v-if="errors.country">@{{errors.country[0]}}</span>
                          </div>
                        </div>
                        <!--div class="form-group row">
                          <div class="col-md-4">
                            <label class="col-md-4" for="">@lang('Company_Admin/dashboard.Post code'):*</label>
                            <div class="col-md-6 pull-right">
                              <input class="form-control"
                              style="padding-left: 18px;" type="text"
                              v-model:value="postcode"
                              v-on:keyup.enter="getAddress"
                              v-on:change="address=''; city=''"
                              required>
                              <span style="color:red;" v-if="errors.postcode">@{{errors.postcode[0]}}</span>
                            </div>
                          </div-->
                          <!--div class="col-md-4" style="">
                            <label class="col-md-6" for="">@lang('common.House Number'):*</label>
                            <div class="col-md-6">
                              <input class="form-control" type="number"
                              v-model:value="houseNumber"
                              v-on:keyup.enter="getAddress"
                              v-on:change="address=''; city=''"
                              required>
                              <span style="color:red;" v-if="errors.houseNumber">@{{errors.houseNumber[0]}}</span>
                            </div>
                          </div-->
                          <!-- disable postocode request by client!-->
                          <!--div class="col-md-4" style="">
                            <label class="col-md-6" for="">@lang('common.House Number'):*</label>
                            <div class="col-md-6">
                              <input class="form-control" type="number"
                              v-model:value="houseNumber"
                              required>
                              <span style="color:red;" v-if="errors.houseNumber">@{{errors.houseNumber[0]}}</span>
                            </div>
                          </div-->
                          <!--div class="col-md-2" style="">
                          </div-->
                        </div>
                        <div class="form-group row">
                          <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.Address'):*</label>
                          <div class="col-md-8">
                            <input class="form-control" type="text" v-model:value="address">
                            <span style="color:red;" v-if="errors.address">@{{errors.address[0]}}</span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.City'):*</label>
                          <div class="col-md-8">
                            <input class="form-control" type="text" v-model:value="city">
                            <span style="color:red;" v-if="errors.city">@{{errors.city[0]}}</span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Password'):*</label>
                          <div class="col-md-8">
                            <div class="form-group input-group">
                              <input :type="passwordField" class="form-control" name="country" v-model:value="pass">
                              <span class="input-group-addon"> <button type="button" name="button" @click.prevent="chageVisibility"><i :class="eyeIcon"></i></button></span>
                            </div>
                            <p v-if='pass.length < 6' style="color:red;">@lang('Company_Admin/dashboard.At least 6 characters long')</p>
                          </div>
                        </div>

                        <div class="inline pull-right">
                          <button type="button" @click.prevent="saveDetails" class="btn btn-success">@lang('Company_Admin/dashboard.Add')</button>
                          <a href="{{ route('customer.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
                        </div>
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
  <script src="{{asset('public/js/vue.min.js')}}"></script>
  <script src="{{asset('public/js/test/dist/vue-phone-number-input.umd.min.js')}}" charset="utf-8"></script>
  <script type="text/javascript">

  </script>
  <script src="{{asset('public/select2/dist/js/select2.min.js')}}"></script>
  <script src="{{asset('public/js/lodash.min.js')}}"></script>
  <script src="{{asset('public/js/axios.min.js')}}"></script>
  <script src="{{asset('public/js/vue-select-latest.js')}}"></script>
  <script src="{{asset('public/js/vue.min.js')}}"></script>

  <script src="https://unpkg.com/vue-swal"></script>

  <script src="{{asset('public/js/Customer/add.js')}}"></script>
  @endsection

@extends('Super_Admin.layouts.admin')

@section('outer_css')
  <style>
    [v-cloak] {
      display: none;
    }
  </style>
@endsection

@section('content')
  <section class="content">
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Companies Management')</h1>
      </div>
      <div class="col-md-4 text-right">
      </div>
    </div>
    <div class="row" id="app" v-cloak>
      <input type="hidden" ref="language" value="{{App::getLocale()}}">
      <div class="col-xs-12" >
        <div class="box">
          <div class="box-header" style="text-align:center;">
            <h3 class="box-title" ><b>@lang('common.Add new company')</b></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="padding-left: 150px; padding-right:150px;">
              <div class="form-group row">
                <label for="">@lang('Super_Admin/dashboard.Name'):*</label>
                  <div class="col-10">
                    <input class="form-control" type="text" v-model:value="name">
                    <span style="color:red;" v-if="errors.name">@{{errors.name[0]}}</span>
                  </div>
                </div>

                <div class="form-group row" style="height: 105px;">
                  <div class="form-group col-md-6" style="padding-left: 0px;">
                    <label for="">@lang('Super_Admin/dashboard.Email'):*</label>
                    <input class="form-control" type="email" v-model:value="email">
                    <span style="color:red;" v-if="errors.email">@{{errors.email[0]}}</span>                    
                  </div>
                  <div class="form-group col-md-6" style="padding-right: 0px;">
                    <label for="">@lang('Super_Admin/dashboard.Password'):*</label>
                    <div class="form-group input-group">
                      <input :type="passwordField" class="form-control" name="country" v-model:value="pass">
                      <span class="input-group-addon"> <button type="button" name="button" @click.prevent="chageVisibility"><i :class="eyeIcon"></i></button></span>
                    </div>
                    <p v-if='pass.length < 6' style="color:red;">@lang('Company_Admin/dashboard.At least 6 characters long')</p>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="">@lang('Super_Admin/dashboard.contact_person'):*</label>
                  <div class="col-10">
                    <input class="form-control" type="text" v-model:value="contact_person">
                    <span style="color:red;" v-if="errors.contact_person">@{{errors.contact_person[0]}}</span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="">@lang('Super_Admin/dashboard.Phone'):*</label>
                  <div class="col-10">
                    <vue-phone-number-input default-country-code="NL" @update="onUpdate" v-model="phone"/>
                    <span style="color:red;" v-if="errors.phone">@{{errors.phone[0]}}</span>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="form-group col-md-6" style="padding-left: 0px;">
                    <label for="">@lang('Company_Admin/dashboard.Post code'):</label>
                      <input 
                        class="form-control"
                        type="text"
                        v-model:value="postcode"
                        >
                      <span style="color:red;" v-if="errors.postcode">@{{errors.postcode[0]}}</span>
                  </div>
                  <div class="form-group col-md-6" style="padding-right: 0px;">
                    <label for="">@lang('common.House Number'):</label>
                    <input 
                      class="form-control" type="number"
                      v-model:value="houseNumber"
                      >
                    <span style="color:red;" v-if="errors.houseNumber">@{{errors.houseNumber[0]}}</span>                    
                  </div>
                </div>


                <div class="form-group row">
                  <label for="">@lang('Super_Admin/dashboard.Address'):*</label>
                  <div class="col-10">
                    <input class="form-control" type="text" v-model:value="address">
                    <span style="color:red;" v-if="errors.address">@{{errors.address[0]}}</span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="">@lang('Super_Admin/dashboard.City'):*</label>
                  <div class="col-10">
                    <input class="form-control" type="text" v-model:value="city">
                    <span style="color:red;" v-if="errors.city">@{{errors.city[0]}}</span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="">@lang('Super_Admin/dashboard.Country'):*</label>
                  <div class="col-10">
                    <input class="form-control" type="text" v-model:value="country">
                    <span style="color:red;" v-if="errors.country">@{{errors.country[0]}}</span>
                  </div>
                </div>


                <div class="form-group row">
                  <div class="form-group col-md-2"  style="padding-left: 0px;">
                    <input type="checkbox" name="allow_leaves" value="true" checked v-model="allow_leaves">  
                    <label for="">@lang('Super_Admin/dashboard.allow_leave_in_app') </label>
                  </div>
                  <div class="form-group col-md-2" style="padding-right: 0px;">
                    <input type="checkbox" name="allow_leaves" value="true" checked v-model="is_active">  
                    <label for="">@lang('Super_Admin/dashboard.is_active') </label>
                  </div>
                </div>

                <div class="inline pull-right">
                  <button class="btn btn-success btn-md" type="button" @click.prevent="saveDetails" name="button">@lang('Super_Admin/dashboard.Add')</button>
                  <a class="btn btn-danger" href="{{route('supadmin.companiesIndex')}}">@lang('Super_Admin/dashboard.Cancel')</a>
                </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

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
  <script src="{{asset('js/test/dist/vue-phone-number-input.umd.min.js')}}" charset="utf-8"></script>
<script src="https://unpkg.com/vue-swal"></script>

<script src="{{asset('js/Company/add.js')}}"></script>
@endsection

@extends('Company_Admin.layouts.main')

@section('outer_css')
  <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
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
        <h1>@lang('common.Staff Management')</h1>
      </div>
    </div>

    <div class="row" id="app" v-cloak>
      <input type="hidden" ref="language" value="{{App::getLocale()}}">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            @lang('common.Add new staff')
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <div class="">

              <div class="form-group row">
                <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Name'):*</label>
                <div class="col-md-4">
                  <input class="form-control" type="text" v-model:value="name">
                  <span style="color:red;" v-if="errors.name">@{{errors.name[0]}}</span>
                </div>
                <label class="col-md-2" for=""> @lang('Company_Admin/dashboard.Employee Code'):</label>
                <div class="col-md-4">
                  <input class="form-control" type="text" v-model:value="employee_code" >
                  <span style="color:red;" v-if="errors.name">@{{errors.employee_code[0]}}</span>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Email'):*</label>
                <div class="col-md-4">
                  <input class="form-control" type="email" v-model:value="email">
                  <span style="color:red;" v-if="errors.email">@{{errors.email[0]}}</span>
                </div>
                <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Phone'):*</label>
                <div class="col-md-4">
                  <vue-phone-number-input default-country-code="NL" @update="onUpdate" v-model="phone"/>
                  <span style="color:red;" v-if="errors.phone">@{{errors.phone[0]}}</span>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-2" for=""> @lang('Company_Admin/dashboard.Gender'):*</label>
                <div class="col-md-4">
                  <select class="form-control" name="gender" v-model:value="gender">
                      <option value="" disabled>@lang('Company_Admin/dashboard.Gender')</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                  </select>
                  <span style="color:red;" v-if="errors.name">@{{errors.Gender[0]}}</span>
                </div>
                <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Visa Expiry Date'):</label>
                <div class="col-md-4">
                  <input type="date" name="visa_expiry_date" class="form-control"  v-model:value="visa_expiry_date">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Passport Expiry Date'):</label>
                <div class="col-md-4">
                  <input type="date" name="passport_expiry_date" class="form-control"  v-model:value="passport_expiry_date">
                </div>
                <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Health Card Expiry Date'):</label>
                <div class="col-md-4">
                  <input type="date" name="health_card_expiry_date" class="form-control"  v-model:value="health_card_expiry_date">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Role') :*</label>
                <div class="col-md-4">
                  <select class="form-control" name="role" onchange="hideShowDiv(this)" v-model="role">
                    <option value="worker" selected>Worker</option>
                    <option value="supervisor">Supervisor</option>
                    <option value="manager">Manager</option>
                  </select>
                </div>

                <div id="supervisors">
                  <label class="col-md-2" for="">@lang('Company_Admin/dashboard.report_to'):*</label>
                  <div class="col-md-4">
                    <select class="form-control" name="role" v-model="supervisor_id" id="sup-select">
                      <option value="" disabled>@lang('Company_Admin/dashboard.Select Supervisor')</option>
                      @foreach($supervisors as $key => $supervisor)
                        <option value="{{$key}}">{{$supervisor}}</option>
                      @endforeach
                    </select>
                    <span style="color:red;" v-if="errors.supervisor_id">@{{errors.supervisor_id[0]}}</span>
                  </div>
                </div>

                <div id="managers">
                  <label class="col-md-2" for="">@lang('Company_Admin/dashboard.report_to'):*</label>
                  <div class="col-md-4">
                    <select class="form-control" name="role" v-model="manager_id" id="man-select">
                      <option value="" disabled>Select Manager</option>
                      @foreach($managers as $key => $manager)
                        <option value="{{$key}}">{{$manager}}</option>
                      @endforeach
                    </select>
                    <span style="color:red;" v-if="errors.manager_id">@{{errors.manager_id[0]}}</span>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div id="agency">
                  <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Associated') @lang('Company_Admin/dashboard.Agency'):</label>
                  <div class="col-md-4">
                    <select class="form-control" name="role" v-model="agency_id" id="multi-select2">
                      <option value="" disabled>@lang('Company_Admin/dashboard.Select Agency')</option>
                      @foreach($agencies as $key => $agency)
                        <option value="{{$key}}">{{$agency}}</option>
                      @endforeach
                    </select>
                    <span style="color:red;" v-if="errors.agency_id">@{{errors.agency_id[0]}}</span>
                  </div>
                </div>

                <div id="workerType">
                  <label class="col-md-2" for="">@lang('common.Worker type'):*</label>
                  <div class="col-md-4">
                    <select class="form-control" name="role" v-model="worker_type_id" id="multi-select1">
                      <option value="" disabled>@lang('Company_Admin/dashboard.Select worker type')</option>
                      @foreach($types as $key => $type)
                        <option value="{{$key}}">{{$type}}</option>
                      @endforeach
                    </select>
                    <span style="color:red;" v-if="errors.worker_type_id">@{{errors.worker_type_id[0]}}</span>
                  </div>
                </div>

                @if(Auth::user()->companyAllowedSickLeaves(Auth::user()->id))
                  <div id="permissions">
                    <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Permissions'):*</label>
                    <div class="col-md-8">
                      @foreach($permissions as $key => $permission)
                        <div class="inline">
                          <input type="checkbox" id="{{$permission->id}}" value="{{$permission->id}}" v-model="checkedPermissions">
                          <label for="{{$permission->id}}">@lang("Company_Admin/dashboard.$permission->name")</label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                @endif
              </div>

              <div class="form-group row">
                @if(!empty($shifts))
                  <div id="shift">
                    <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Shift'):</label>
                    <div class="col-md-4">
                      <select class="form-control" name="role" v-model="shift_id" id="multi-select2">
                        <option value="" disabled>@lang('Company_Admin/dashboard.Select Shift')</option>
                        @foreach($shifts as $key => $shift)
                          <option value="{{$key}}">{{$shift}}</option>
                        @endforeach
                      </select>
                      <span style="color:red;" v-if="errors.shift_id">@{{errors.shift_id[0]}}</span>
                    </div>
                  </div>
                @endif

                <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Password'):*</label>
                <div class="col-md-4">
                  <div class="form-group input-group">
                    <input :type="passwordField" class="form-control" name="country" v-model:value="pass">
                    <span class="input-group-addon"> <button type="button" name="button" @click.prevent="chageVisibility"><i :class="eyeIcon"></i></button></span>
                  </div>
                  <p v-if='pass.length < 6' style="color:red;">@lang('Company_Admin/dashboard.At least 6 characters long')</p>
                </div>
              </div>

              <div class="inline pull-right">
                <button type="button" @click.prevent="saveDetails" class="btn btn-success">@lang('Company_Admin/dashboard.Add')</button>
                <a href="{{ route('staff.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
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
  <script src="{{asset('js/vue.min.js')}}"></script>
  <script src="{{asset('js/test/dist/vue-phone-number-input.umd.min.js')}}" charset="utf-8"></script>
  <script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
  <script src="{{asset('js/lodash.min.js')}}"></script>
  <script src="{{asset('js/axios.min.js')}}"></script>
  <script src="{{asset('js/vue-select-latest.js')}}"></script>
  <script src="{{asset('js/vue.min.js')}}"></script>
  <script src="https://unpkg.com/vue-swal"></script>

  <script src="{{asset('js/staff/add.js')}}"></script>
  <script>
    $( window ).on( "load", function() {
      $('#managers').hide();
      $('#permissions').hide();
    });

    // $('#multi-select1').select2();
    // $('#multi-select2').select2();
    // $('#sup-select').select2();
    // $('#man-select').select2();

    function hideShowDiv(sel) {
      if (sel.value == 'supervisor') {
        $('#permissions').show();
        $('#workerType').hide();
        $('#agency').hide();
        $('#managers').show();
        $('#supervisors').hide();
      }
      else if(sel.value == 'manager') {
        $('#permissions').hide();
        $('#workerType').hide();
        $('#agency').hide();
        $('#managers').hide();
        $('#supervisors').hide();
      }
      else if(sel.value == 'worker') {
        $('#permissions').hide();
        $('#workerType').show();
        $('#agency').show();
        $('#managers').hide();
        $('#supervisors').show();
      }
    }

    function changeMode() {
      let type = document.getElementById('pass').type;
      if (type === 'password') {
        document.getElementById('pass').type = 'text';
      }else {
        document.getElementById('pass').type = 'password';
      }
    }
  </script>

@endsection

<!-- Content Header (Page header) -->

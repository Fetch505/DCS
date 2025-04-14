@extends('Company_Admin.layouts.main')

@section('title', 'Dashboard')

<div id="wrapper">
  @section('content')
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Staff Management')</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            @lang('common.Edit staff')
          </div>
          <div class="panel-body">
          <div id="app">
            {{ Form::model($user,['route' => ['staff.update',$user->id], 'method' => 'PUT', 'data-parsley-validate' => '']) }}
            <input type="hidden" id="language" value="{{App::getLocale()}}">
            
            <div class="form-group row">
              <label class="col-md-2" for=""> @lang('Company_Admin/dashboard.Name'):*</label>
              <div class="col-md-4">
                {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
              </div>
              <label class="col-md-2" for=""> @lang('Company_Admin/dashboard.Employee Code'):</label>
              <div class="col-md-4">
                {{ Form::text('employee_code', null, ['class' => 'form-control']) }}
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Email'):*</label>
              <div class="col-md-4">
                {{ Form::email('email', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
              </div>
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Phone'):*</label>
              <div class="col-md-4">
                {{ Form::text('phone', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Gender'):*</label>
              <div class="col-md-4">
              {{ Form::select('gender', ['Male' => 'Male', 'Female' => 'Female'], null, ['class' => 'form-control',]) }}
              </div>
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Visa Expiry Date'):</label>
              <div class="col-md-4">
              {{ Form::date('visa_expiry_date', null, ['class' => 'form-control',]) }}
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Passport Expiry Date'):</label>
              <div class="col-md-4">
                {{ Form::date('passport_expiry_date', null, ['class' => 'form-control',]) }}
              </div>
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Health Card Expiry Date'):</label>
              <div class="col-md-4">
                {{ Form::date('health_card_expiry_date', null, ['class' => 'form-control',]) }}
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Role') :*</label>
              <div class="col-md-4">
                <select class="form-control" name="role" onchange="hideShowDiv(this)">
                  @foreach($roles as $key=>$role)
                    <option value="{{$role}}" {{ ($user->role_id == $key)? 'selected':'' }}>{{$role}}</option>
                  @endforeach
                </select>
              </div>

              <div id="supervisors"
                  @if($user->role->name == 'supervisor' || $user->role->name == 'manager')
                  style="display:none"
                      @endif
              >
                <label class="col-md-2" for="">@lang('Company_Admin/dashboard.report_to'):*</label>
                <div class="col-md-4">
                  <select class="form-control" name="supervisor_id" id="sup-select">
                  <option value="">select supervisor</option>
                    @foreach($supervisors as $key=>$supervisor)
                      <option value="{{$key}}" {{ ($user->reports_to_id == $key)? 'selected':'' }}>{{$supervisor}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div id="managers"
                  @if($user->role->name == 'user' || $user->role->name == 'manager')
                  style="display:none"
                      @endif
              >
                <label class="col-md-2" for="">@lang('Company_Admin/dashboard.report_to'):*</label>
                <div class="col-md-4">
                  <select class="form-control" name="manager_id" id="man-select">
                  <option value="">select manager</option>
                    @foreach($managers as $key=>$manager)
                      <option value="{{$key}}" {{ ($user->reports_to_id == $key)? 'selected':'' }}>{{$manager}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group row"> 
              <div id="agency"
                 @if($user->role->name == 'supervisor' || $user->role->name == 'manager')
                 style="display:none"
                    @endif
              >
                <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Associated') @lang('Company_Admin/dashboard.Agency'):</label>
                <div class="col-md-4">
                  {{ Form::select('agency_id', $agencies, $user->employment_agency_id ? $user->employment_agency_id : null, ['class' => 'form-control','id' => 'multi-select2', 'placeholder' => 'Select Agency...'])}}
                </div>
              </div>

              <div id="workerType"
                 @if($user->role->name == 'supervisor' || $user->role->name == 'manager')
                 style="display:none"
                    @endif
              >
                <label class="col-md-2" for="">@lang('common.Worker type'):*</label>
                <div class="col-md-4">
                  {{ Form::select('worker_type_id', $types, $user->worker_type_id ? $user->worker_type_id : null, ['class' => 'form-control','id' => 'multi-select1', 'placeholder' => 'Select Type...'])}}
                </div>
              </div>
            </div>

            <div class="form-group row" id="permissions"
                 @if($user->role->name == 'user' || $user->role->name == 'manager')
                 style="display:none"
                    @endif
            >
              @if(Auth::user()->companyAllowedSickLeaves(Auth::user()->id))
                <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Permissions'):*</label>
                <div class="col-md-8">
                  @foreach ($status as $key => $permission)
                    @if($permission['before'])
                      <div class="inline">
                        {{ Form::checkbox('Permission'.$key, $permission['id'], true) }}
                        <?php $name = $permission['name']; ?>
                        <label for="description">@lang("Company_Admin/dashboard.$name")</label>
                      </div>
                    @else
                      <div class="inline">
                        {{ Form::checkbox('Permission'.$key, $permission['id']) }}
                        <?php $name = $permission['name']; ?>
                        <label for="description">@lang("Company_Admin/dashboard.$name")</label>
                      </div>
                    @endif
                  @endforeach
                </div>
              @endif
            </div>
              
            <div class="form-group row">
              @if(!empty($shifts))
                <div id="shift">
                  <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Shift'):</label>
                  <div class="col-md-4">
                    {{ Form::select('shift_id', $shifts, $user->shift_id ? $user->shift_id : null, ['class' => 'form-control','id' => 'multi-select2', 'placeholder' => 'Select Shift'])}}
                    </div>
                </div>
              @endif            
            
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Password'):</label>
              <div class="col-md-4">
                <div class="form-group input-group">
                  <input type="password" id="pass" class="form-control" name="password" value="">
                  <span class="input-group-addon"> <button type="button" name="button" onclick="changeMode()"><i class="fa fa-eye"></i></button></span>
                </div>
              </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Resigned'):</label>
                <div class="col-md-4">
                    {{ Form::hidden('resign', 0) }}
                    {{ Form::checkbox('resign', 1 , $user->resign ? true : false, ['id' => 'resignCheckbox', 'onchange' => 'toggleResignDateField()']) }}
                </div>

                <div id="resignDateField" 
                  @if($user->resign == false)
                    style="display:none"
                  @endif
                >
                  <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Last Working Day'):</label>
                  <div class="col-md-4">
                    {{ Form::date('resign_date',($user->resign_date)? $user->resign_date :  null, ['class' => 'form-control',]) }}
                  </div>
                </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Active / Inactive'):</label>
              <div class="col-md-4">
                {{ Form::select('status', ['1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control', '@change' => 'confirmStatusChange'])  }}
              </div>
            </div>

            <div class="inline pull-right">
              <button type="submit" class="btn btn-success">@lang('Company_Admin/dashboard.Save')</button>
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
  <script>
    var userId = {{ $user->id }};
  </script>
  <script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
  <script src="{{asset('js/axios.min.js')}}"></script>
  <script src="{{asset('js/vue-select-latest.js')}}"></script>
  <script src="{{asset('js/vue.min.js')}}"></script>
  <script type="text/javascript"></script>
  <script src="https://unpkg.com/vue-swal"></script>
  <script src="{{asset('js/staff/edit.js')}}"></script>
  <script src="{{asset('js/staff/editJquery.js')}}"></script>
@endsection

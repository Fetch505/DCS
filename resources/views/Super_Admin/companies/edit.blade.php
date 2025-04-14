@extends('Super_Admin.layouts.admin')

@section('content')
  <section class="content">
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Companies Management')</h1>
      </div>
      <div class="col-md-4 text-right">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12" >
        <div class="box">
          <div class="box-header" style="text-align:center;">
            <h3 class="box-title" ><b>@lang('common.Edit company')</b></h3>
          </div>
          <div class="box-body" style="padding-left: 150px; padding-right:150px;">
            {{ Form::model($company,['route' => ['supadmin.updateCompany',$company->id], 'method' => 'POST', 'data-parsley-validate' => '']) }}

              <input type="hidden" id="language" value="{{App::getLocale()}}">
              <div class="form-group row">
                <label for="">@lang('Super_Admin/dashboard.Name'):*</label>
                  <div class="col-10">
                    {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                  </div>
                </div>

                <div class="form-group row">
                  <div class="form-group col-md-6" style="padding-left: 0px;">
                    <label for="">@lang('Super_Admin/dashboard.Email'):*</label>
                      {{ Form::email('email', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                  </div>
                  <div class="form-group col-md-6" style="padding-right: 0px;">
                    <label for="">@lang('Super_Admin/dashboard.Password'):*</label>
                    <input type="password" class="form-control" name="password">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="">@lang('Super_Admin/dashboard.contact_person'):*</label>
                  <div class="col-10">
                    {{ Form::text('contact_person1', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                  </div>
                </div>
                <div class="form-group row">
                  @lang('Super_Admin/dashboard.Phone'):*
                  <div class="col-10">
                    {{ Form::text('phone', null, ['class' => 'form-control', 'required' => '', 'placeholder' => '+31xxxxxxxxx']) }}
                  </div>
                </div>
                <div class="form-group row">
                  <div class="form-group col-md-6" style="padding-left: 0px;">
                    <label for="">@lang('Company_Admin/dashboard.Post code'):</label>
                      <input class="form-control" id="postCode" name="postcode"
                      type="text"
                      value="{{$company->postcode}}">
                  </div>
                  <div class="form-group col-md-6" style="padding-right: 0px;">
                    <label for="">@lang('common.House Number'):</label>
                      <input class="form-control" id="houseNumber" name="houseNumber" type="text"
                      value="{{$company->houseNumber}}">
                  </div>

                </div>
                <div class="form-group row">
                  @lang('Super_Admin/dashboard.Address'):*
                  <div class="col-10">
                    {{ Form::text('address', null, ['class' => 'form-control','id' => 'address', 'required' => '', 'maxlength' => '255']) }}
                  </div>
                </div>
                <div class="form-group row">
                  @lang('Super_Admin/dashboard.City'):*
                  <div class="col-10">
                    {{ Form::text('city', null, ['class' => 'form-control','id' => 'city', 'required' => '', 'maxlength' => '255']) }}
                  </div>
                </div>
                <div class="form-group row">
                  @lang('Super_Admin/dashboard.Country'):*
                  <div class="col-10">
                    {{ Form::text('country', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                  </div>
                </div>

                <div class="form-group row">
                  <div class="form-group col-md-2"  style="padding-left: 0px;">
                    <input type="checkbox" name="allow_leaves" value="true"
                    @if($company->allow_leaves == 1) checked=checked @endif
                    >
                    <label for="">@lang('Super_Admin/dashboard.allow_leave_in_app') </label>                    
                  </div>
                  <div class="form-group col-md-2" style="padding-right: 0px;">
                    <input type="checkbox" name="is_active" value="true"
                    @if($company->is_active == 1) checked=checked @endif
                    >
                    <label for="">@lang('Super_Admin/dashboard.is_active') </label>                    
                  </div>
                </div>


                <div class="inline pull-right">
                  <button class="btn btn-success btn-md" type="submit" name="button">@lang('Super_Admin/dashboard.Save')</button>
                  <a class="btn btn-danger" href="{{route('supadmin.companiesIndex')}}">@lang('Super_Admin/dashboard.Cancel')</a>
                </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('outer_script')
<script src="{{asset('public/js/Company/editJquery.js')}}"></script>

@endsection

@extends('Company_Admin.layouts.main')



@section('title', 'Dashboard')

  <div id="wrapper">
    @section('content')
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Employment Agencies Management')</h1>
      </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('common.Edit agency')
                </div>
                <div class="panel-body">
                  {{ Form::model($employAgency,['route' => ['employ_agency.update',$employAgency->id], 'method' => 'PUT', 'data-parsley-validate' => '']) }}
                  <input type="hidden" id="language" value="{{App::getLocale()}}">
                  <div class="form-group row">
                    <label class="col-md-2" for="">@lang('Super_Admin/dashboard.Name'):*</label>
                      <div class="col-md-8">
                        {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('Super_Admin/dashboard.Email'):*</label>
                      <div class="col-md-8">
                        {{ Form::email('email', null, ['class' => 'form-control', 'readonly'=>true, 'required' => '', 'maxlength' => '255']) }}
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('common.URL'):*</label>
                      <div class="col-md-8">
                        {{ Form::text('url', null, ['class' => 'form-control', 'maxlength' => '255']) }}
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Contact') @lang('Company_Admin/dashboard.Person'):*</label>
                      <div class="col-md-8">
                        {{ Form::text('contact_person', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Phone'):*</label>
                      <div class="col-md-8">
                        {{ Form::text('phone', null, ['class' => 'form-control', 'required' => '', 'placeholder' => '+31xxxxxxxxxxx', 'maxlength' => '255']) }}
                      </div>
                    </div>
                    <div class="form-group row">
                      <!--div class="col-md-4">
                        <label class="col-md-4" for="">@lang('Company_Admin/dashboard.Post code'):*</label>
                        <div class="col-md-6 pull-right">
                          <input class="form-control" id="postCode" name="postcode"
                          style="padding-left: 18px;" type="text"
                          required value="{{$employAgency->postcode}}" readonly="true">
                        </div>
                      </div-->
                      <!--div class="col-md-4" style="">
                        <label class="col-md-6" for="">@lang('common.House Number'):*</label>
                        <div class="col-md-6">
                          <input class="form-control" id="houseNumber" name="houseNumber" type="text"
                          value="{{$employAgency->houseNumber}}" readonly="true">

                        </div>
                      </div-->
                      <!--div class="col-md-2" style="">
                        <button class="btn btn-danger btn-md" type="button" name="button" onclick="editPostcode()"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-success btn-md" id="getAddres" type="button" name="button" onclick="getAddress()" disabled="true"><i class="fa fa-arrow-circle-right"></i></button>
                      </div-->
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('Super_Admin/dashboard.Address'):*</label>
                      <div class="col-md-8">
                        {{ Form::text('address', null, ['class' => 'form-control','id' => 'address', 'required' => '', 'maxlength' => '255']) }}
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('Super_Admin/dashboard.City'):*</label>
                      <div class="col-md-8">
                        {{ Form::text('city', null, ['class' => 'form-control','id' => 'city', 'required' => '', 'maxlength' => '255']) }}
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('Super_Admin/dashboard.Country'):*</label>
                      <div class="col-md-8">
                        {{ Form::text('country', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                      </div>
                    </div>

                    <div class="inline pull-right">
                        <button type="submit" class="btn btn-success">@lang('Super_Admin/dashboard.Save')</button>
                        <a href="{{ route('employ_agency.index') }}" type="button" class="btn btn-danger">@lang('Super_Admin/dashboard.Cancel')</a>
                    </div>
                  {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    @endsection
  </div>

  @section('outer_script')
  <script src="{{asset('public/js/Empl_agency/editJquery.js')}}"></script>
  @endsection

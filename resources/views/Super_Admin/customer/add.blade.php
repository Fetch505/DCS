@extends('Super_Admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
  <section class="content">
    <div class="row">
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
                    {{ Form::open(['route' => 'customer.store', 'method' => 'POST', 'data-parsley-validate' => '']) }}

                      <div class="form-group row">
                        <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Name'):*</label>
                          <div class="col-md-8">
                            {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                          </div>
                        </div>

                        <div class="form-group row">
                          <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.Email'):*</label>
                          <div class="col-md-8">
                            {{ Form::email('email', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.Phone'):*</label>
                          <div class="col-md-8">
                            {{ Form::text('phone', null, ['class' => 'form-control', 'required' => '', 'placeholder' => '+31xxxxxxxxxxx']) }}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.Address'):*</label>
                          <div class="col-md-8">
                            {{ Form::text('address', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.City'):*</label>
                          <div class="col-md-8">
                            {{ Form::text('city', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label  class="col-md-2" for="">@lang('Company_Admin/dashboard.Country'):*</label>
                          <div class="col-md-8">
                            {{ Form::text('country', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Password'):*</label>
                          <div class="col-md-8">
                            <input type="password" class="form-control" name="password" value="">
                          </div>
                        </div>

                        <div class="inline pull-right">
                          <button type="submit" class="btn btn-success">@lang('Company_Admin/dashboard.Add')</button>
                          <a href="{{ route('sup_customer.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
                        </div>
                    {{ Form::close() }}
                  </div>
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection

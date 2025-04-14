@extends('Company_Admin.layouts.main')

@section('title', 'Dashboard')

  <div id="wrapper">
    @section('content')
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('Company_Admin/dashboard.Suppliers') @lang('Company_Admin/dashboard.Management')</h1>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  @lang('Company_Admin/dashboard.Add') @lang('Company_Admin/dashboard.New') @lang('Company_Admin/dashboard.Supplier')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <div class="">
                    {{ Form::open(['route' => 'supplier.store', 'method' => 'POST', 'data-parsley-validate' => '']) }}

                      <div class="form-group row">
                        <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Supplier') @lang('Company_Admin/dashboard.Name'):*</label>
                          <div class="col-md-8">
                            {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                          </div>
                        </div>

                      <div class="form-group row">
                        <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Supplier') @lang('Company_Admin/dashboard.Email'):*</label>
                          <div class="col-md-8">
                            {{ Form::email('email', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Supplier') @lang('Company_Admin/dashboard.Contact'):*</label>
                          <!-- {{ Form::label('contact', 'Supplier Contact:*', ['class' => 'col-md-2 col-form-label']) }} -->
                            <div class="col-md-8">
                              {{ Form::text('contact', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Supplier') @lang('Company_Admin/dashboard.Address'):*</label>
                            <!-- {{ Form::label('address', 'Supplier Address:*', ['class' => 'col-md-2 col-form-label']) }} -->
                              <div class="col-md-8">
                                {{ Form::text('address', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                              </div>
                            </div>

                        <div class="inline pull-right">
                          <button type="submit" class="btn btn-success">@lang('Company_Admin/dashboard.Add')</button>
                          <a href="{{ route('supplier.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
                        </div>

                    {{ Form::close() }}
                  </div>

                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    @endsection
  </div>

<!-- Content Header (Page header) -->

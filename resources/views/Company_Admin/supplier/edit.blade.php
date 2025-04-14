@extends('Company_Admin.layouts.main')

@section('title', 'Dashboard')

  <div id="wrapper">
    @section('content')
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('Company_Admin/dashboard.Suppliers') @lang('Company_Admin/dashboard.Management')</h1>
      </div>
      <!-- <div class="col-md-4 text-right">
        <a href="{{route('supplier.create')}}", class="btn btn-primary btn-sm" style="margin-top: 30px; margin-left: 15px;"><i class="fa fa-plus" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Edit') @lang('Company_Admin/dashboard.Suppliers')</a>
      </div> -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('Company_Admin/dashboard.List Of All') @lang('Company_Admin/dashboard.Suppliers')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  {{ Form::model($supplier,['route' => ['supplier.update',$supplier->id], 'method' => 'PUT', 'data-parsley-validate' => '']) }}

                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Supplier') @lang('Company_Admin/dashboard.Name'):*</label>
                        <div class="col-md-8">
                            {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Supplier') @lang('Company_Admin/dashboard.Email'):*</label>
                        <div class="col-md-8">
                            {{ Form::email('email', null, ['class' => 'form-control', 'required' => '']) }}
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
                        <button type="submit" class="btn btn-success">@lang('Company_Admin/dashboard.Save')</button>
                        <a href="{{ route('supplier.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
                    </div>
                  {{ Form::close() }}
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    @endsection
  </div>

  @section('outer_script')
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{asset('vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
  <script src="{{asset('dist2/js/sb-admin-2.js')}}"></script>
  <script>
  $(function () {
    $('#table').DataTable({
          responsive: true
      });
  })

  </script>
  @endsection
<!-- Content Header (Page header) -->

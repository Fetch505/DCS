@extends('Super_Admin.layouts.admin')

@section('title', 'Create new worker type')

@section('content')
  <!-- Content Header (Page header) -->
 <!-- End of the Top Row -->
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('Super_Admin/dashboard.Worker') @lang('Super_Admin/dashboard.Types') @lang('Super_Admin/dashboard.Management')</h1>
      </div>
      <div class="col-md-4 text-right">

      </div>
    </div>
    <div class="row">
      <div class="col-xs-12" >
        <div class="box">
          <div class="box-header" style="text-align:center;">
            <h3 class="box-title" ><b>@lang('Super_Admin/dashboard.Add') @lang('Super_Admin/dashboard.Worker') @lang('Super_Admin/dashboard.Type')</b></h3>
          </div>
          <!-- /.box-header -->
            <div class="box-body" style="padding-left: 150px; padding-right:150px;">
                {{ Form::open(['route' => 'workerTypes.store', 'method' => 'POST', 'data-parsley-validate' => '']) }}

                <label for="">@lang('Super_Admin/dashboard.Name')</label>
                <!-- {{ Form::label('name', 'Name:*') }} -->
                {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                <br>
                <div class="inline pull-right">
                  <button class="btn btn-success btn-md" type="submit" name="button">@lang('Super_Admin/dashboard.Add')</button>
                  <!-- {{ Form::submit('ADD', ['class'=>'btn btn-success btn-md ']) }} -->
                  <a class="btn btn-danger" href="{{route('workerTypes.index')}}">@lang('Super_Admin/dashboard.Cancel')</a>
                </div>


              {{ Form::close() }}

            </div>

          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->

@endsection

@extends('Super_Admin.layouts.admin')

@section('outer_css')
    <link href="{{asset('public/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
  <section class="content">
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('Super_Admin/dashboard.Workers') @lang('Super_Admin/dashboard.Management')</h1>
      </div>
      <div class="col-md-4 text-right">

      </div>
    </div>
    <div class="row">
      <div class="col-xs-12" >
        <div class="box">
          <div class="box-header" style="text-align:center;">
            <h3 class="box-title" ><b>@lang('Super_Admin/dashboard.Add') @lang('Super_Admin/dashboard.New') @lang('Super_Admin/dashboard.Worker')</b></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="padding-left: 150px; padding-right:150px;">
            {{ Form::open(['route' => 'supadmin.saveUser', 'method' => 'POST', 'data-parsley-validate' => '']) }}

            <div class="form-group row">
              <a class="btn btn-primary pull-right" href="{{route('workerTypes.create')}}">@lang('Super_Admin/dashboard.Add') @lang('Super_Admin/dashboard.New') @lang('Super_Admin/dashboard.Worker') @lang('Super_Admin/dashboard.Type') </a>
            </div>
              <div class="form-group row">
                <label for="">@lang('Super_Admin/dashboard.Name'):*</label>
                  <div class="col-10">
                    {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                  </div>
                </div>

                <div class="form-group row">
                  <label for="">@lang('Super_Admin/dashboard.Email'):*</label>
                  <div class="col-10">
                    {{ Form::email('email', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label for="">@lang('Super_Admin/dashboard.Phone'):*</label>
                  <div class="col-10">
                    {{ Form::text('phone', null, ['class' => 'form-control', 'required' => '', 'placeholder' => '+31xxxxxxxxxxx']) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label for="">@lang('Super_Admin/dashboard.Address'):*</label>
                  <div class="col-10">
                    {{ Form::text('address', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label for="">@lang('Super_Admin/dashboard.City'):*</label>
                  <div class="col-10">
                    {{ Form::text('city', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label for="">@lang('Super_Admin/dashboard.Country'):*</label>
                  <div class="col-10">
                    {{ Form::text('country', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                  </div>
                </div>
                <div class="form-group row">
                  <label for="">@lang('Super_Admin/dashboard.Password'):*</label>
                  <div class="col-10">
                    <div class="form-group input-group">
                      <input type="password" id="pass" class="form-control" name="password" value="">
                      <span class="input-group-addon"> <button type="button" name="button" onclick="changeMode()"><i class="fa fa-eye"></i></button></span>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="inline">
                    <label for="">@lang('Super_Admin/dashboard.Worker') @lang('Super_Admin/dashboard.Type'):*</label>
                    <div class="col-10">
                      {{ Form::select('worker_type', $types, null, ['class' => 'form-control','id' => 'multi-select', 'placeholder' => 'Select Type...'])}}
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="">@lang('Super_Admin/dashboard.Permissions'):*</label>
                  <div class="col-10" style="padding-left:50px;">
                    @foreach($permissions as $key => $permission)
                    <div class="inline">
                      {{ Form::checkbox('Permission'.$key, $permission->id) }}
                      {{ Form::label('description', $permission->name) }}
                    </div>
                    <br>
                    @endforeach
                  </div>
                </div>

                <div class="inline pull-right">
                  <button class="btn btn-success btn-md" type="submit" name="button">@lang('Super_Admin/dashboard.Add')</button>
                  <a class="btn btn-danger" href="{{route('users.index')}}">@lang('Super_Admin/dashboard.Cancel')</a>
                </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('outer_script')
<script src="{{asset('../../public/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('../../public/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('../../public/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('../../public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('../../public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('../../public/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('../../public/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('../../public/dist/js/demo.js')}}"></script>
<!-- page script -->
<script src="{{asset('public/select2/dist/js/select2.min.js')}}"></script>
<script>
      $('#multi-select').select2();
</script>
<script>
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

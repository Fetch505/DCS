@extends('Super_Admin.layouts.admin')

@section('outer_css')
    <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
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
            <h3 class="box-title" ><b>@lang('Super_Admin/dashboard.Edit') @lang('Super_Admin/dashboard.Worker')</b></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="padding-left: 150px; padding-right:150px;">
            {{ Form::model($user,['route' => ['supadmin.updateUser',$user->id], 'method' => 'POST', 'data-parsley-validate' => '']) }}

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
                    {{ Form::text('phone', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
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
                  <div class="inline">
                    <label for="">@lang('Super_Admin/dashboard.Worker') @lang('Super_Admin/dashboard.Type'):*</label>
                    <div class="col-10">
                      {{ Form::select('worker_type_id', $types, $user->worker_type_id ? $user->worker_type_id : null, ['class' => 'form-control','id' => 'multi-select', 'placeholder' => 'Select Type...'])}}
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="">@lang('Super_Admin/dashboard.Permissions'):*</label>
                  <div class="col-10" style="padding-left:50px;">
                    @foreach ($status as $key => $permission)
                      @if($permission['before'])
                      <div class="inline">
                        {{ Form::checkbox('Permission'.$key, $permission['id'], true) }}
                        {{ Form::label('description', $permission['name']) }}
                      </div>
                      @else
                      <div class="inline">
                        {{ Form::checkbox('Permission'.$key, $permission['id']) }}
                        {{ Form::label('description', $permission['name']) }}
                      </div>
                      @endif
                      <br>
                    @endforeach
                  </div>
                </div>

                <div class="inline pull-right">
                  <button class="btn btn-success btn-md" type="submit" name="button">@lang('Super_Admin/dashboard.Save')</button>
                  <a class="btn btn-danger" href="{{route('users.index')}}">@lang('Super_Admin/dashboard.Cancel')</a>
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
<script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
<script>
      $('#multi-select').select2();
</script>
<script>
  $(function () {
    $('#example1').DataTable()
    // $('#example2').DataTable({
    //   'paging'      : true,
    //   'lengthChange': false,
    //   'searching'   : false,
    //   'ordering'    : true,
    //   'info'        : true,
    //   'autoWidth'   : false
    // })
  })
</script>
@endsection

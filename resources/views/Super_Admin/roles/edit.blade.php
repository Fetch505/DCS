@extends('Super_Admin.layouts.admin')

@section('content')
  <!-- Content Header (Page header) -->
 <!-- End of the Top Row -->
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Roles Management')</h1>
      </div>
      <div class="col-md-4 text-right">
        <!-- <a href="#", class="btn btn-success btn-sm" style="margin-top: 30px; margin-left: 15px;"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a> -->
        <!-- <a href="#", class="btn btn-primary btn-sm" style="margin-top: 30px; margin-left: 15px;"> Export to Excel</a> -->

      </div>
    </div>
    <div class="row">
      <div class="col-xs-12" >
        <div class="box">
          <div class="box-header" style="text-align:center;">
            <h3 class="box-title" ><b>@lang('common.Edit role')</b></h3>
          </div>
          <div class="box-body" style="padding-left: 150px; padding-right:150px;">
              {{ Form::model($role,['route' => ['sup_admin.updateRole',$role->id], 'method' => 'POST', 'data-parsley-validate' => '']) }}

              <label for="">@lang('Super_Admin/dashboard.Role') @lang('Super_Admin/dashboard.Name'):*</label>
              {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
              <br>

              <label for="">@lang('Super_Admin/dashboard.Description'):*</label>
              {{ Form::text('description', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
              <br>
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

              <div class="inline pull-right">
                <button class="btn btn-success btn-md" type="submit" name="button">@lang('Super_Admin/dashboard.Save')</button>
                <!-- {{ Form::submit('SAVE', ['class'=>'btn btn-success btn-md ']) }} -->
                <a class="btn btn-danger" href="{{route('sup_admin.rolesIndex')}}">@lang('Super_Admin/dashboard.Cancel')</a>
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

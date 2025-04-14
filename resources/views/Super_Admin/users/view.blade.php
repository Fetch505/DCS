@extends('Super_Admin.layouts.admin')

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
            <h3 class="box-title" ><b>@lang('Super_Admin/dashboard.Workers') @lang('Super_Admin/dashboard.Detail')</b></h3>
          </div>
          <div class="box-body" style="padding-left: 150px; padding-right:150px;">
            <a class="btn btn-primary pull-right" href="{{route('supadmin.workersIndex')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i>@lang('Super_Admin/dashboard.Back')</a>
            <div class="col-md-12">
              <div class="col-md-8 col-md-offset-4">
                <div class="inline">
                  <label for="name">@lang('Super_Admin/dashboard.Name'):</label>
                  <span style="position: absolute; left: 150px;">{{$user->name}}</span>
                </div>
                <br>
                <div class="inline">
                  <label for="name">@lang('Super_Admin/dashboard.Worker') @lang('Super_Admin/dashboard.Type'):</label>
                  <span style="position: absolute; left: 150px;">{{$user->worker_type->name}}</span>
                </div>
                <br>
                <div class="inline">
                  <label for="name">@lang('Super_Admin/dashboard.Role'):</label>
                  <span style="position: absolute; left: 150px;">{{$user->role->name}}</span>
                </div>
                <br>
                <div class="inline">
                  <label for="name">@lang('Super_Admin/dashboard.Email'):</label>
                  <span style="position: absolute; left: 150px;">{{$user->email}}</span>
                </div>
                <br>
                <div class="inline">
                  <label for="name">@lang('Super_Admin/dashboard.Address'):</label>
                  <span style="position: absolute; left: 150px;">{{$user->address}}</span>
                </div>
                <br>
                <div class="inline">
                  <label for="name">@lang('Super_Admin/dashboard.Phone'):</label>
                  <span style="position: absolute; left: 150px;">{{$user->phone}}</span>
                </div>
                <br>
                <div class="inline">
                  <label for="name">@lang('Super_Admin/dashboard.City'):</label>
                  <span style="position: absolute; left: 150px;">{{$user->city}}</span>
                </div>
                <br>
                <br>
                <div class="inline">
                  <label for="name">@lang('Super_Admin/dashboard.Permissions Assigned'):</label>
                  <ul style="padding-left:150px; list-style-type:square">
                    @foreach ($user->permissions as $permission)
                      <li> <i>{{$permission->name}}</i> </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
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

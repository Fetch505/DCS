@extends('Super_Admin.layouts.admin')

@section('content')
  <!-- Content Header (Page header) -->
 <!-- End of the Top Row -->
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('Super_Admin/dashboard.Users') @lang('Super_Admin/dashboard.Management')</h1>
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
            <h3 class="box-title" ><b>@lang('Super_Admin/dashboard.User') @lang('Super_Admin/dashboard.Detail')</b></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="padding-left: 150px; padding-right:150px;">
            <a class="btn btn-primary pull-right" href="{{route('supadmin.usersIndex')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i>@lang('Super_Admin/dashboard.Back')</a>
            <div class="col-md-12">
              <div class="col-md-8 col-md-offset-4">
                <div class="inline">
                  <label for="name">@lang('Super_Admin/dashboard.Name'):</label>
                  <span style="position: absolute; left: 150px;">{{$user->name}}</span>
                </div>
                <br>

                <div class="inline">
                  <label for="name">@lang('Super_Admin/dashboard.Role'):</label>
                  <span style="position: absolute; left: 150px;">{{$user->role->name}}</span>
                </div>
                <br>
                @if($user->role_id == 3)
                      <div class="inline">
                        <label for="name">@lang('Super_Admin/dashboard.Worker') @lang('Super_Admin/dashboard.Type'):</label>
                        <span style="position: absolute; left: 150px;">{{$user->worker_type->name}}</span>
                      </div>
                      <br>
                      @if(isset($user->employment_agency_id))
                        <div class="inline">
                          <label for="name">@lang('Super_Admin/dashboard.Associated With'):</label>
                          <span style="position: absolute; left: 150px;">{{$user->agency->name}}</span>
                        </div>
                        <br>
                      @else
                        <div class="inline">
                          <label for="name">@lang('Super_Admin/dashboard.Associated With'):</label>
                          <span style="position: absolute; left: 150px;">{{$user->company->name}}</span>
                        </div>
                        <br>
                      @endif
                @elseif ($user->role_id == 4)
                  <div class="inline">
                    <label for="name">@lang('Super_Admin/dashboard.Associated With'):</label>
                    <span style="position: absolute; left: 150px;">{{$user->company->name}}</span>
                  </div>
                  <br>
                @endif

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
                <div class="inline">
                  <label for="name">@lang('Super_Admin/dashboard.Zip Code'):</label>
                  <span style="position: absolute; left: 150px;">{{$user->zipcode}}</span>
                </div>
                <br>
                <br>
                @if ($user->role_id == 3 ||  $user->role_id == 2)
                  <div class="inline">
                    <label for="name">@lang('Super_Admin/dashboard.Permissions Assigned'):</label>
                    <ul style="padding-left:150px; list-style-type:square">
                      @foreach ($user->permissions as $permission)
                        <li> <i>{{$permission->name}}</i> </li>
                      @endforeach
                    </ul>
                  </div>
                @endif
              </div>
            </div>

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

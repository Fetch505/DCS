@extends('Super_Admin.layouts.admin')

@section('content')
<script>

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

</script>

  <section class="content">
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('Super_Admin/dashboard.Users') @lang('Super_Admin/dashboard.Management') </h1>
      </div>
      <div class="col-md-4 text-right">
        <!-- <a href="", class="btn btn-primary btn-sm" style="margin-top: 30px; margin-left: 15px;">@lang('Super_Admin/dashboard.Add') @lang('Super_Admin/dashboard.New') @lang('Super_Admin/dashboard.User')</a> -->
        <!-- <a href="#", class="btn btn-primary btn-sm" style="margin-top: 30px; margin-left: 15px;"> Export to Excel</a> -->

      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><b>@lang('Super_Admin/dashboard.List Of All Users')</b></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Sr#</th>
                <th>@lang('Super_Admin/dashboard.Name')</th>
                <th>@lang('Super_Admin/dashboard.Role')</th>
                <th>@lang('Super_Admin/dashboard.Email')</th>
                <th>@lang('Super_Admin/dashboard.Associated With')</th>
                <th>@lang('Super_Admin/dashboard.Status')</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <td>{{$user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->role->name }}</td>
                  <td>{{ $user->email }}</td>
                  @if ($user->role_id == 3)
                    @if(isset($user->employment_agency_id))
                      <td>{{ $user->agency->name }}</td>
                    @else
                      <td>{{ $user->company->name }}</td>
                    @endif
                  @elseif ($user->role_id == 4)
                    <td>{{ $user->company->name }}</td>
                  @else
                    <td></td>
                  @endif

                  <td>{{ $user->status ? "Active":"In Active" }}</td>
                  <td>
                    <h4>
                      <a href="{{route('supadmin.viewAllUser',$user->id)}}"  data-toggle="tooltip" data-placement="top" title="@lang('Super_Admin/dashboard.View')"><i class="fa fa-eye view-icon" style="color:blue;"></i></a>

                      @if ($user->status)
                      	<a href="{{ route('supadmin.statusChange',$user->id) }}" data-toggle="tooltip" data-placement="top" title="@lang('Super_Admin/dashboard.InActivate')" onclick="return confirm('Are you sure you want to InActivate this user ?')"><i class="fa fa-power-off suspend-icon" style="color:green;"></i></a>
    									@else
    										<a href="{{ route('supadmin.statusChange',$user->id) }}" data-toggle="tooltip" data-placement="top" title="@lang('Super_Admin/dashboard.Activate')" onclick="return confirm('Are you sure you want to Activate this user ?')"><i class="fa fa-power-off suspend-icon" style="color:red;"></i></a>
    									@endif

                      <!-- <a href="{{route('supadmin.editUser',$user->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('Super_Admin/dashboard.Edit')"><i class="fa fa-pencil-square-o" style="color:green;"></i></a> -->

                      <a href="{{route('supadmin.deleteUser',$user->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('Super_Admin/dashboard.Delete')" onclick="return confirm('Are you sure you want to Delete this user ?')"><i class="fa fa-times" style="color:red;"></i></a>
                    <h4>



                  </td>
                </tr>
                @endforeach
              </tbody>

            </table>

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
<script src="{{asset('public/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('public/dist/js/demo.js')}}"></script>
<script>

///////////////// Below block is used to localize DataTable data //////////////
 let languageSelected = document.getElementById('languageSwitcher').value;

 if(languageSelected == 'en') {
   $(function () {
     $('#example1').DataTable()
   })

 } else {
   $(function () {
     $('#example1').DataTable({
       language: {
         sProcessing: "Bezig...",
         sLengthMenu: "Laten zien _MENU_ entries",
         sZeroRecords: "Geen resultaten gevonden",
         sInfo: "_START_ tot _END_ van _TOTAL_ resultaten",
         sInfoEmpty: "Geen resultaten om weer te geven",
         sInfoFiltered: " (gefilterd uit _MAX_ resultaten)",
         sInfoPostFix: "",
         sSearch: "Zoeken:",
         sEmptyTable: "Geen resultaten aanwezig in de tabel",
         sInfoThousands: ".",
         sLoadingRecords: "Een moment geduld aub - bezig met laden...",
         oPaginate: {
           sFirst: "Eerste",
           sLast: "Laatste",
           sNext: "Volgende",
           sPrevious: "Vorige"
         },
         oAria: {
           sSortAscending: ": activeer om kolom oplopend te sorteren",
           sSortDescending: ": activeer om kolom aflopend te sorteren"
           }
         }
     })
   })

 }

/////////////////////////////////////////////////////////////////////////

</script>
@endsection

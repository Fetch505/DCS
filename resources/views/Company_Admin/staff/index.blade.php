@extends('Company_Admin.layouts.main')

@section('title', 'Dashboard')
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
  <div id="wrapper">
    @section('content')
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Staff Management')</h1>
      </div>
      <div class="col-md-4 text-right">
        <a href="{{route('staff.create')}}", class="btn btn-primary btn-sm" style="margin-top: 30px; margin-left: 15px;"><i class="fa fa-plus" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Add New')</a>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  @lang('common.List of staff')
                </div>
                <div class="panel-body">
                    <table width="100%" id="table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                              <!--th>@lang('Company_Admin/dashboard.Sr #')</th-->
                              <th>@lang('Company_Admin/dashboard.Employee Code')</th>
                              <th>@lang('Company_Admin/dashboard.Name')</th>
                              <th>@lang('Company_Admin/dashboard.Designation')</th>
                              <th>@lang('Company_Admin/dashboard.Role')</th>
                              <th data-orderable="false">@lang('Company_Admin/dashboard.Email')</th>
                              <th>@lang('Company_Admin/dashboard.Agency')</th>
                              @if($shift_count>0)
                                <th>@lang('Company_Admin/dashboard.Shift')</th>
                              @endif
                              <th>@lang('Company_Admin/dashboard.Phone')</th>
                              <th>@lang('Company_Admin/dashboard.Status')</th>
                              <th>@lang('Company_Admin/dashboard.Active / Inactive')</th>
                              <th data-orderable="false"></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $key=>$user)
                            <tr>
                              <!--td>{{++$key }}</td-->
                              <td>{{ $user->employee_code }}</td>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->worker_type ? $user->worker_type->name : '' }}</td>
                              <td>{{ ($user->isInspector()) ? 'Inspector' : $user->role->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>{{ $user->agency ? $user->agency->name : '' }}</td>
                              @if($shift_count>0)
                                <td>{{ $user->shift ? $user->shift->title : '' }}</td>
                              @endif
                              <!--td>{{ $user->status ? "Active":"Deactive" }}</td-->
                              <td>{{ $user->phone }}</td>
                              <td>
                                @if($user->loggedIn)
                                  <span style="color: green; font-weight: bold;">Online</span>
                                @else
                                  <span style="color: red; font-weight: bold;">Offline</span>
                                @endif
                              </td>
                              <td>
                                @if($user->status == 1)
                                  <span>Active</span>
                                @else
                                  <span style="color: red;">Inactive</span>
                                @endif
                              </td>

                              <td style="text-align:center;">
                                    <a href="{{route('staff.show',$user->id)}}"  data-toggle="tooltip" data-placement="top" title="@lang('Company_Admin/dashboard.View')@lang('Company_Admin/dashboard.Details') "><i class="fa fa-eye view-icon" style="color:blue;"></i></a>
<!--
                                    @if ($user->status)
                                    	<a href="{{ route('staff.statusChange',$user->id) }}" data-toggle="tooltip" data-placement="top" title="@lang('Super_Admin/dashboard.Activate')" onclick="return confirm('Are you sure you want to Activate this user ?')"><i class="fa fa-power-off suspend-icon" style="color:green;"></i></a>
                  									@else
                  										<a href="{{ route('staff.statusChange',$user->id) }}" data-toggle="tooltip" data-placement="top" title="@lang('Super_Admin/dashboard.DeActivate')" onclick="return confirm('Are you sure you want to Deactivate this user ?')"><i class="fa fa-power-off suspend-icon" style="color:red;"></i></a>
                  									@endif -->

                                    <a href="{{route('staff.edit',$user->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('Company_Admin/dashboard.Edit')"><i class="fa fa-pencil-square-o" style="color:green;"></i></a>

                                    <!--a href="{{route('staff.delete',$user->id)}}" data-toggle="tooltip" data-placement="top"  onclick="return confirm('Are you sure you want to delete this user ?')" title="@lang('Company_Admin/dashboard.Delete')"><i class="fa fa-times" style="color:red;"></i></a-->
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
  </div>

  @section('outer_script')
  <script src="{{asset('public/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('public/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('public/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{asset('public/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
  <script src="{{asset('public/dist2/js/sb-admin-2.js')}}"></script>
  <script>

  ///////////////// Below block is used to localize DataTable data //////////////
   let languageSelected = document.getElementById('languageSwitcher').value;

   if(languageSelected == 'en') {
     $(function () {
       $('#table').DataTable()
     })

   } else {
     $(function () {
       $('#table').DataTable({
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

@extends('Super_Admin.layouts.admin')
@section('content')
  <section class="content">
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Roles Management')</h1>
      </div>
      <div class="col-md-4 text-right">
        <a href="{{route('sup_admin.createRole')}}", class="btn btn-primary btn-sm" style="margin-top: 30px; margin-left: 15px;">@lang('common.Add new')</a>
        <!-- <a href="#", class="btn btn-primary btn-sm" style="margin-top: 30px; margin-left: 15px;"> Export to Excel</a> -->

      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><b>@lang('common.List of roles')</b></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>@lang('Company_Admin/dashboard.Sr #')</th>
                <th>@lang('Super_Admin/dashboard.Name')</th>
                <th>@lang('Super_Admin/dashboard.Description')</th>
                <th>@lang('Super_Admin/dashboard.Permissions Assigned')</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
                @foreach($roles as $key => $role)
                <tr>
                  <td>{{ ++$key }}</td>
                  <td>{{ $role->name }}</td>
                  <td>{{ $role->description }}</td>
                  <td>
                      @foreach($role->permissions as $key => $permission)
                       {{$permission->name}}
                       ,
                      @endforeach
                  </td>
                  <td>
                    <h4>
                      <a href="{{route('sup_admin.editRole',$role->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('Super_Admin/dashboard.Edit')"><i class="fa fa-pencil-square-o" style="color:blue;"></i></a>

                      <a href="{{route('sup_admin.deleteRole',$role->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('Super_Admin/dashboard.Delete')"><i class="fa fa-times" style="color:red;"></i></a>
                    </h4>
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
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('dist/js/demo.js')}}"></script>
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

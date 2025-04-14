@extends('Super_Admin.layouts.admin')

@section('title', 'Dashboard')
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>

@section('content')
<section class="content">
  <div class="row">
    <div class="col-sm-8">
      <h1>@lang('common.Employee Group Management')</h1>
    </div>
    <div class="col-md-4 text-right">
      <a href="{{route('hourlyRateIndex')}}", class="btn btn-danger btn-sm" style="margin-top: 30px; margin-left: 15px;"><i class="fa fa-arrow-left"></i> @lang('Company_Admin/dashboard.Back')</a>

      <a href="{{route('employeeGroup.create')}}", class="btn btn-primary btn-sm" style="margin-top: 30px; margin-left: 15px;"><i class="fa fa-plus" aria-hidden="true"></i> @lang('common.Add new')</a>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          @lang('common.List of employee group')
        </div>
        <div class="panel-body table-responsive">
          <table width="100%" id="table" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>@lang('Company_Admin/dashboard.Sr #')</th>
                <th>@lang('Company_Admin/dashboard.Name')</th>
                <th>@lang('Company_Admin/dashboard.gros_hr_wage')</th>
                <th>@lang('Company_Admin/dashboard.total_end_wage')</th>
                <th>@lang('Company_Admin/dashboard.Created On')</th>
                <th>@lang('Company_Admin/dashboard.updated On')</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($employeeGroups as $key=>$employeeGroup)
              <tr>
                <td>{{++$key}}</td>
                <td width="30px;">{{$employeeGroup->name}}</td>
                <td>{{$employeeGroup->gross_hour_wage}}</td>
                <td>{{$employeeGroup->	marge_loonkosten_eindtarief}}</td>
                <td>{{date('d-M-Y', strtotime($employeeGroup->created_at))}}</td>
                <td>{{date('d-M-Y', strtotime($employeeGroup->updated_at))}}</td>
                <td>
                  <a class="btn btn-primary" href="{{route('employeeGroup.edit',$employeeGroup->id)}}"><i class="fa fa-edit"></i> Edit</a>

                  <a  class="btn btn-success" href="{{route('employeeGroup.show',$employeeGroup->id)}}"><i class="fa fa-eye"></i> View</a> </td>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

  @section('outer_script')
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{asset('vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
  <script src="{{asset('dist2/js/sb-admin-2.js')}}"></script>
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
<!-- Content Header (Page header) -->

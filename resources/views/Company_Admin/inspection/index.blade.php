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
      <h1>@lang('common.Inspection reports')</h1>
    </div>
    <div class="col-md-4 text-right">
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          @lang('common.List of reports')
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <table width="100%" id="table" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>@lang('Company_Admin/dashboard.Sr #')</th>
                <th>@lang('common.Customer name')</th>
                <th>@lang('common.Project name')</th>
                <th>@lang('common.Inspection date')</th>
                <th data-orderable="false"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($inspectionReports as $key => $report)
              <tr>
                <td>{{ ++$key}}</td>
                <td>{{ $report->project->customer->name }}</td>
                <td>{{ $report->project->name }}</td>
                <td>{{ date('M j, Y', strtotime($report->created_at)) }}</td>
                <td style="text-align:center;">
                  <a href="{{ route('inspection.view', $report->id) }}" data-toggle="tooltip" data-placement="top" title="@lang('Company_Admin/dashboard.Download') PDF"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;"></i></a>
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
  </script>
  @endsection
<!-- Content Header (Page header) -->

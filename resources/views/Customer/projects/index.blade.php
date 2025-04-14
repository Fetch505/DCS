@extends('Customer.layouts.admin')

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
        <h1>@lang('Customer/dashboard.My') @lang('Customer/dashboard.Projects')</h1>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('Company_Admin/dashboard.List Of All') @lang('Company_Admin/dashboard.Projects')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" id="table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Company_Admin/dashboard.Sr #')</th>
                                <th>@lang('Customer/dashboard.Project') @lang('Customer/dashboard.Name')</th>
                                <th>@lang('Customer/dashboard.Associated') @lang('Customer/dashboard.Company')</th>
                                <th>@lang('Customer/dashboard.Total') @lang('Customer/dashboard.Areas')</th>
                                <th>@lang('Customer/dashboard.Total') @lang('Customer/dashboard.Tasks')</th>
                                <th>@lang('Customer/dashboard.Start Date')</th>
                                <th>@lang('Customer/dashboard.End Date')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($projects as $key=>$project)
                            <tr>
                                <td>{{ ++$key}}</td>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->customer->user->company->name }}</td>
                                <td>{{ ($project->areas) ? $project->areas->count() : '' }}</td>
                                @php $count = 0; @endphp
                                @foreach($project->areas as $area)
                                  {{$count = $count + $area->tasks->count()}}
                                @endforeach
                                <td>{{ $count }}</td>
                                <td>{{ date('M j, Y', strtotime($project->start_date)) }}</td>
                                <td>{{ $project->end_date ? date('M j, Y', strtotime($project->end_date)) : 'Not Completed Yet' }}</td>
                                <td style="text-align:center;">
                                    <a href="{{route('customer.projectDetail',$project->id)}}"  data-toggle="tooltip" data-placement="top" title="@lang('Customer/dashboard.View') @lang('Customer/dashboard.Details') "><i class="fa fa-eye view-icon" style="color:blue;"></i></a>
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

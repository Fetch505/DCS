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
      <h1>@lang('common.Workable day management')</h1>
    </div>
    <div class="col-md-4 text-right">
      <a href="{{route('hourlyRateIndex')}}", class="btn btn-danger btn-sm" style="margin-top: 30px; margin-left: 15px;"><i class="fa fa-arrow-left"></i> @lang('Company_Admin/dashboard.Back')</a>

      <a href="{{route('workableDaysCalculation.create')}}", class="btn btn-primary btn-sm" style="margin-top: 30px; margin-left: 15px;"><i class="fa fa-plus" aria-hidden="true"></i> @lang('common.Add new')</a>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          @lang('common.List of workable days')
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body table-responsive">
          <table width="100%" id="table" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>@lang('Company_Admin/dashboard.Sr #')</th>
                <th>@lang('Company_Admin/dashboard.Year')</th>
                <th>@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.workable_days')</th>
                <th>@lang('Company_Admin/dashboard.un_workable_days_percent')</th>
                <th>@lang('Company_Admin/dashboard.Created On')</th>
                <th>@lang('Company_Admin/dashboard.updated On')</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($workableDays as $key=>$workableDay)
              <tr>
                <td>{{++$key}}</td>
                <td>{{$workableDay->year}}</td>
                <td>{{$workableDay->workable_days_a_year}}</td>
                <td>{{$workableDay->	rage_unworkable_days_in_percent}}</td>
                <td>{{date('d-M-Y', strtotime($workableDay->created_at))}}</td>
                <td>{{date('d-M-Y', strtotime($workableDay->updated_at))}}</td>
                <td>
                  <a class="btn btn-primary" href="{{route('workableDaysCalculation.edit',$workableDay->id)}}"><i class="fa fa-edit"></i> Edit</a>

                  <a  class="btn btn-success" href="{{route('workableDaysCalculation.show',$workableDay->id)}}"><i class="fa fa-eye"></i> View</a> </td>
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

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
        <h1>@lang('Company_Admin/dashboard.Materials') @lang('Company_Admin/dashboard.Management')</h1>
      </div>
      <div class="col-md-4 text-right">
        <a href="{{ route('showMaterialOrders') }}" class="btn btn-success"  style="margin-top: 30px;"> @lang('Company_Admin/dashboard.Material') @lang('Company_Admin/dashboard.Order')s</a>
        <a href="{{route('material.create')}}" class="btn btn-primary" style="margin-top: 30px; margin-left: 15px;"><i class="fa fa-plus" aria-hidden="true"></i>@lang('Company_Admin/dashboard.Add') @lang('Company_Admin/dashboard.New') @lang('Company_Admin/dashboard.Material')</a>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('Company_Admin/dashboard.List Of All') @lang('Company_Admin/dashboard.Materials')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" id="table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Company_Admin/dashboard.Sr #')</th>
                                <th>@lang('Company_Admin/dashboard.Name')</th>
                                <th>@lang('common.Category')</th>
                                <th>@lang('Company_Admin/dashboard.Type')</th>
                                <th>@lang('Company_Admin/dashboard.Price')</th>
                                <th>@lang('Company_Admin/dashboard.Unassigned') @lang('Company_Admin/dashboard.Quantity')</th>
                                <th>@lang('Company_Admin/dashboard.Minimum') @lang('Company_Admin/dashboard.Quantity')</th>
                                <th data-orderable="false"></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($materials as $key => $material)
                            <tr style="color: {{ $material->quantity < $material->limit ? 'red' : 'black' }}">
                                <td>{{ ++$key}}</td>
                                <td>{{ $material->name }}</td>
                                <td>{{ $material->materialType->materialCategory->name }}</td>
                                <td>{{ $material->materialType->name }}</td>
                                <td>{{ $material->price }}</td>
                                <td>{{ $material-> quantity }}</td>
                                <td>{{ $material-> limit }}</td>
                                <td style="text-align:center;">
                                    <a href="{{route('material.show',$material->id)}}"  data-toggle="tooltip" data-placement="top" title="@lang('Company_Admin/dashboard.View')@lang('Company_Admin/dashboard.Details') "><i class="fa fa-eye view-icon" style="color:blue;"></i></a>
                                    <a href="{{route('material.edit',$material->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('Company_Admin/dashboard.Edit')"><i class="fa fa-pencil-square-o" style="color:green;"></i></a>
                                </td>
                            </tr>
                          @endforeach


                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
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
<!-- Content Header (Page header) -->

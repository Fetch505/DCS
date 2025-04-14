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
        <h1>@lang('common.Customers Management')</h1>
      </div>
      <div class="col-md-4 text-right">
        {{-- <a href="{{route('sup_customer.create')}}", class="btn btn-primary btn-sm" style="margin-top: 30px; margin-left: 15px;"><i class="fa fa-plus" aria-hidden="true"></i> @lang('common.Add new')</a> --}}
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  @lang('common.List of companies')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" id="table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Company_Admin/dashboard.Sr #')</th>
                                <th>@lang('Company_Admin/dashboard.Name')</th>
                                <th data-orderable="false">@lang('Company_Admin/dashboard.Email')</th>
                                <th>@lang('Company_Admin/dashboard.Company')</th>
                                <th data-orderable="false">@lang('Company_Admin/dashboard.Phone')</th>
                                <th data-orderable="false">@lang('Company_Admin/dashboard.Address')</th>
                                <th data-orderable="false"></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($customers as $key => $customer)
                            <tr>
                                <td>{{ ++$key}}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->user ? $customer->user->email : '' }}</td>
                                <td>{{ $customer->company ? $customer->company->name : ''}}</td>
                                <td>{{ $customer->user ? $customer->user->phone : '' }}</td>
                                <td>{{ $customer->user ? $customer->user->address : '' }}</td>
                                <td style="text-align:center;">
                                    <a href="{{route('sup_customer.show',$customer->id)}}"  data-toggle="tooltip" data-placement="top" title="View Details"><i class="fa fa-eye view-icon" style="color:blue;"></i></a>

                                    {{-- <a href="{{route('sup_customer.edit',$customer->id)}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o" style="color:green;"></i></a>

                                    <a href="{{route('customer.delete',$customer->id)}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-times" style="color:red;"></i></a> --}}
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

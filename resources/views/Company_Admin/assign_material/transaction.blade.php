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
        <h1>@lang('common.Projects Management')</h1>
    </div>
   
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  {{$project->name}}
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" id="table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Company_Admin/dashboard.Sr #')</th>
                                <th>@lang('Company_Admin/dashboard.Date')</th>
                                <th>@lang('Company_Admin/dashboard.Quantity')</th>
                                <th>Goods Receipt</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($materialTransactions as $key => $transaction)
                            <tr>
                                <td>{{ ++$key}}</td>
                                <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('Y-m-d') }}</td>
                                <td>{{ $transaction->total_quantity }}</td>
                                <td style="text-align:center">
                                  @if ($transaction->payment_proof !== '')
                                    <a href="#" title="View Details" class="view-icon" data-toggle="modal" data-target="#myModal" data-image-url="{{ $transaction->payment_proof }}" >
                                      <i class="fa fa-eye view-icon" style="color:blue"></i>
                                    </a>
                                  @endif
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->

                    <!-- Create the modal markup -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Payment Proof</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!-- Modal body content -->
                            <div class="image-container"  style="position: relative; width: 100%; padding-bottom: 50%;">
                              <img id="imagePreview" src="" alt="Payment Proof" style="position: absolute; width: 100%; height: 100%; object-fit: contain;">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


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

<script>
  $(document).ready(function() {
    $('.view-icon').click(function() {
      var imageUrl = $(this).data('image-url');
      $('#imagePreview').attr('src', imageUrl);
    });

    // Clear the video source when the modal is closed
    $('#myModal').on('hidden.bs.modal', function() {
      $('#imagePreview').attr('src', '');
    });
  });
</script>

  @endsection
<!-- Content Header (Page header) -->

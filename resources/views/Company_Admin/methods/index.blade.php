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
        <h1>@lang('common.Methods Management')</h1>
    </div>
   
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('common.List of methods')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" id="table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Company_Admin/dashboard.Sr #')</th>
                                <th >@lang('common.Category')</th>
                                <th>@lang('Company_Admin/dashboard.Title')</th>
                                <th data-orderable="false">@lang('Company_Admin/dashboard.Description')</th>
                                <th data-orderable="false"></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($methods as $key => $method)
                            <tr>
                                <td>{{ ++$key}}</td>
                                <td>{{ $method->category_id ? $method->category->name : '' }}</td>
                                <td>{{ $method->title }}</td>
                                <td>{{ $method->description }}</td>
                                <td style="text-align:center">
                                  <a href="#" title="View Details" class="view-icon" data-toggle="modal" data-target="#myModal" data-video-url="{{ $method->video_url }}" >
                                    <i class="fa fa-eye view-icon" style="color:blue"></i>
                                  </a></td>
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
                            <h4 class="modal-title" id="myModalLabel">Method Video</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!-- Modal body content -->
                            <div class="video-container" style="position: relative; width: 100%; padding-bottom: 56.25%;">
                              <video class="video-fluid modal-video" controls autoplay style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                <source src="" type="video/mp4">
                                Your browser does not support the video tag.
                              </video>
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

<script>
  $(document).ready(function() {
    $('.view-icon').click(function() {
      var videoUrl = $(this).data('video-url');
      $('#myModal').find('video').attr('src', videoUrl);
    });

    // Clear the video source when the modal is closed
    $('#myModal').on('hidden.bs.modal', function() {
      $('#myModal').find('video').attr('src', '');
    });
  });
</script>

  @endsection
<!-- Content Header (Page header) -->

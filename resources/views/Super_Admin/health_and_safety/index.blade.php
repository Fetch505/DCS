@extends('Super_Admin.layouts.admin')

@section('outer_css')
  <link href="{{asset('multiple-select/multiple-select.css')}}" rel="stylesheet"/>
@endsection

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
        <h1>@lang('common.Health And Safety Management')</h1>
      </div>
      <div class="col-md-4 text-right">
        <a href="{{route('health.create')}}", class="btn btn-primary btn-sm" style="margin-top: 30px; margin-left: 15px;"><i class="fa fa-plus" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Add New')</a>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('common.List of health and safety')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" id="table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>@lang('Company_Admin/dashboard.Sr #')</th>
                                <th>@lang('common.Category')</th>
                                <th>@lang('Company_Admin/dashboard.Title')</th>
                                <th data-orderable="false">@lang('Company_Admin/dashboard.Description')</th>
                                <th data-orderable="false"></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($healths as $key => $health)
                            <tr>
                                <td>{{ ++$key}}</td>
                                <td>{{ $health->category_id ? $health->category->name : '' }}</td>
                                <td>{{ $health->title }}</td>
                                <td>{{ $health->description }}</td>
                                <td style="text-align:center">
                                  <a href="#" title="View Video" class="view-icon" data-toggle="modal" data-target="#myModal" data-video-url="{{ $health->video_url }}" >
                                    <i class="fa fa-eye view-icon" style="color:blue"></i>
                                  </a>
                                  <a href="{{route('health.edit',$health->id)}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-square-o" style="color:green;"></i></a>
                                  <a href="{{route('health.delete',$health->id)}}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-times" style="color:red;"></i></a>
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
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!-- Modal body content -->
                            <div id="file_view"></div>
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
      var url = $(this).data('video-url');
      // $('#myModal').find('video').attr('src', videoUrl);
      var fileExt = url.split('.').pop().toLowerCase();
      if (isImage(fileExt)) {
          $('#file_view').html('<div class="image-container"  style="position: relative; width: 100%; padding-bottom: 50%;"><img src="' + url + '" alt="Image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>');
      } else if (isVideo(fileExt)) {
          $('#file_view').html('<div class="video-container" style="position: relative; width: 100%; padding-bottom: 56.25%;"><video controls  autoplay style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"><source src="' + url + '" type="video/' + fileExt + '">Your browser does not support the video tag.</video></div>');
      } else if (isPDF(fileExt)) {
          $('#file_view').html('<embed src="' + url + '" type="application/pdf" width="100%" height="600px" />');
      } else {
          $('#file_view').html('Unsupported file type.');
      }
    });

    // Clear the video source when the modal is closed
    $('#myModal').on('hidden.bs.modal', function() {
      $('#myModal').find('video').attr('src', '');
      $('#myModal').find('img').attr('src', '');
      $('#myModal').find('embed').attr('src', '');
    });
  });

  function isImage(ext) {
      return ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].indexOf(ext) !== -1;
  }

  function isVideo(ext) {
      return ['mp4', 'avi', 'mov', 'mkv', 'wmv', 'webm'].indexOf(ext) !== -1;
  }

  function isPDF(ext) {
      return ['pdf'].indexOf(ext) !== -1;
  }
</script>

  @endsection
<!-- Content Header (Page header) -->

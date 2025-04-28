@extends('Company_Admin.layouts.main')

@section('title', 'Dashboard')

@section('content')
<div id="wrapper">
  <div class="row">
    <h1>@lang('common.Health And Safety Management')</h1>
  </div>

  <div class="row mt-4">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          @lang('common.List of health and safety')
        </div>
        <div class="panel-body">
          <table id="table" class="table table-bordered table-striped table-hover" style="width:100%;">
            <thead>
              <tr>
                <th style="width:5%;"       >@lang('Company_Admin/dashboard.Sr #')</th>
                <th style="min-width:150px;">@lang('common.Category')</th>
                <th style="min-width:200px;">@lang('Company_Admin/dashboard.Title')</th>
                <th style="min-width:300px;" data-orderable="false">@lang('Company_Admin/dashboard.Description')</th>
                <th style="width:5%;"       data-orderable="false"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($healths as $key => $health)
                @if($health->status == 1)
                <tr>
                  <td class="text-center">{{ ++$key }}</td>
                  <td>{{ $health->category_id ? $health->category->name : '-' }}</td>
                  <td>{{ $health->title ?? '-' }}</td>
                  <td>{{ $health->description ?? '-' }}</td>
                  <td class="text-center">
                    <a href="#" title="@lang('common.View File')" class="view-icon" data-toggle="modal" data-target="#myModal" data-video-url="{{ $health->video_url }}">
                      <i class="fa fa-eye text-primary"></i>
                    </a>
                  </td>
                </tr>
                @endif
              @endforeach
            </tbody>
          </table>

          <!-- Modal for viewing file -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document"> <!-- Changed to modal-lg -->
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">@lang('common.View File')</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body text-center">
                  <div id="file_view" class="embed-responsive embed-responsive-16by9"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Modal -->

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('outer_script')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-responsive/dataTables.responsive.js') }}"></script>
<script src="{{ asset('dist2/js/sb-admin-2.js') }}"></script>

<script>
$(document).ready(function () {
  const languageSelected = document.getElementById('languageSwitcher')?.value || 'en';
  
  $('#table').DataTable({
    responsive: true,
    language: languageSelected !== 'en' ? {
      sProcessing: "Bezig...",
      sLengthMenu: "Laten zien _MENU_ entries",
      sZeroRecords: "Geen resultaten gevonden",
      sInfo: "_START_ tot _END_ van _TOTAL_ resultaten",
      sInfoEmpty: "Geen resultaten om weer te geven",
      sInfoFiltered: "(gefilterd uit _MAX_ resultaten)",
      sSearch: "Zoeken:",
      sEmptyTable: "Geen resultaten aanwezig in de tabel",
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
    } : {}
  });

  // Modal File Viewer
  $('.view-icon').click(function () {
    const url = $(this).data('video-url');
    const fileExt = url.split('.').pop().toLowerCase();

    let content = '';

    if (isImage(fileExt)) {
      content = `<img src="${url}" class="img-fluid rounded" alt="Image" />`;
    } else if (isVideo(fileExt)) {
      content = `
        <video controls autoplay class="embed-responsive-item">
          <source src="${url}" type="video/${fileExt}">
          Your browser does not support the video tag.
        </video>`;
    } else if (isPDF(fileExt)) {
      content = `<embed src="${url}" type="application/pdf" width="100%" height="600px" class="rounded" />`;
    } else {
      content = '<p class="text-danger">@lang('common.Unsupported File Type')</p>';
    }

    $('#file_view').html(content);
  });

  $('#myModal').on('hidden.bs.modal', function () {
    $('#file_view').empty();
  });
});

// Helpers
function isImage(ext) {
  return ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(ext);
}
function isVideo(ext) {
  return ['mp4', 'avi', 'mov', 'mkv', 'wmv', 'webm'].includes(ext);
}
function isPDF(ext) {
  return ['pdf'].includes(ext);
}
</script>

<style>
#table th, #table td {
  vertical-align: middle !important;
}
#table th {
  white-space: nowrap;
}
.modal-lg {
  max-width: 90%;
}
.modal-body {
  overflow-x: auto;
}
.modal-body img,
.modal-body video,
.modal-body embed {
  max-width: 100%;
  height: auto;
}
</style>
@endsection

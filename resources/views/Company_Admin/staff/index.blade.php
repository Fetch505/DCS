@extends('Company_Admin.layouts.main')

@section('title', 'Dashboard')

@section('content')
<div id="wrapper">
  <div class="row mb-4">
    <div class="col-md-8">
      <h2 class="page-title">@lang('common.Staff Management')</h2>
    </div>
    <div class="col-md-4 text-end">
      <a href="{{ route('staff.create') }}" class="btn btn-primary">
        <i class="fa fa-plus me-1"></i> @lang('Company_Admin/dashboard.Add New')
      </a>
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-header">
      <strong>@lang('common.List of staff')</strong>
    </div>
    <div class="card-body table-responsive">
      <table id="table" class="table table-striped table-bordered align-middle">
        <thead class="table-light">
          <tr>
            <th>@lang('Company_Admin/dashboard.Sr #')</th>
            <th>@lang('Company_Admin/dashboard.Employee Code')</th>
            <th>@lang('Company_Admin/dashboard.Name')</th>
            <th>@lang('Company_Admin/dashboard.Designation')</th>
            <th>@lang('Company_Admin/dashboard.Role')</th>
            <th>@lang('Company_Admin/dashboard.Email')</th>
            <th>@lang('Company_Admin/dashboard.Agency')</th>
            @if($shift_count > 0)
              <th>@lang('Company_Admin/dashboard.Shift')</th>
            @endif
            <th>@lang('Company_Admin/dashboard.Phone')</th>
            <th>@lang('Company_Admin/dashboard.Status')</th>
            <th>@lang('Company_Admin/dashboard.Active / Inactive')</th>
            <th>@lang('common.Actions')</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td>{{ $loop->iteration }}</td>
<td>{{ $user->employee_code }}</td>
<td>{{ $user->name }}</td>
<td>{{ $user->worker_type ? $user->worker_type->name : '' }}</td>
<td>{{ $user->isInspector() ? 'Inspector' : ($user->role ? $user->role->name : '') }}</td>
<td>{{ $user->email }}</td>
<td>{{ $user->agency ? $user->agency->name : '' }}</td>
@if($shift_count > 0)
  <td>{{ $user->shift ? $user->shift->title : '' }}</td>
@endif
<td>{{ $user->phone }}</td>
<td>
  <span class="badge bg-{{ $user->loggedIn ? 'success' : 'danger' }}">
    {{ $user->loggedIn ? 'Online' : 'Offline' }}
  </span>
</td>
<td>
  <span class="badge bg-{{ $user->status ? 'primary' : 'danger' }}">
    {{ $user->status ? 'Active' : 'Inactive' }}
  </span>
</td>
<td class="text-center">
  <a href="{{ route('staff.show', $user->id) }}" class="me-2" data-bs-toggle="tooltip" title="@lang('Company_Admin/dashboard.View')">
    <i class="fa fa-eye text-primary"></i>
  </a>
  <a href="{{ route('staff.edit', $user->id) }}" class="me-2" data-bs-toggle="tooltip" title="@lang('Company_Admin/dashboard.Edit')">
    <i class="fa fa-pencil text-success"></i>
  </a>
  <!-- Uncomment if deletion is enabled -->
  <!-- <a href="{{ route('staff.delete', $user->id) }}" onclick="return confirm('Are you sure?')" data-bs-toggle="tooltip" title="@lang('Company_Admin/dashboard.Delete')">
    <i class="fa fa-times text-danger"></i>
  </a> -->
</td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('outer_script')
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-responsive/dataTables.responsive.js') }}"></script>

<script>
  $(function () {
    $('[data-bs-toggle="tooltip"]').tooltip();

    let languageSelected = document.getElementById('languageSwitcher')?.value || 'en';

    $('#table').DataTable({
      responsive: true,
      language: languageSelected === 'en' ? {} : {
        sProcessing: "Bezig...",
        sLengthMenu: "Laten zien _MENU_ entries",
        sZeroRecords: "Geen resultaten gevonden",
        sInfo: "_START_ tot _END_ van _TOTAL_ resultaten",
        sInfoEmpty: "Geen resultaten om weer te geven",
        sInfoFiltered: " (gefilterd uit _MAX_ resultaten)",
        sSearch: "Zoeken:",
        sEmptyTable: "Geen resultaten aanwezig in de tabel",
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
    });
  });
</script>
@endsection
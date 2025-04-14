@extends('Company_Admin.layouts.main')

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
        <h1>@lang('common.Tasks Management')</h1>
      </div>
      <div class="col-md-4 text-right">
        <a href="{{route('task.create')}}", class="btn btn-primary btn-sm" style="margin-top: 30px; margin-left: 15px;"><i class="fa fa-plus" aria-hidden="true"></i> @lang('common.Add new')</a>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  @lang('common.List of tasks')
                </div>
                <div class="panel-body">
                    <table width="100%" id="table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                              <th>@lang('Company_Admin/dashboard.Sr #')</th>
                              <th>@lang('Company_Admin/dashboard.Element')</th>
                              <th>@lang('Company_Admin/dashboard.Name')</th>
                              <th>@lang('Company_Admin/dashboard.Description')</th>
                              <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($tasks as $key => $task)
                            <tr>
                              <td>{{++$key}}</td>
                              <td>{{ $task->element ? $task->element->name : '' }}</td>
                              <td>{{ $task->name }}</td>
                              <td>{{ $task->description }}</td>
                              <td style="text-align:center;">
                                    <!-- <a href="{{route('task.show',$task->id)}}"  data-toggle="tooltip" data-placement="top" title="@lang('Company_Admin/dashboard.View')@lang('Company_Admin/dashboard.Details') "><i class="fa fa-eye view-icon" style="color:blue;"></i></a> -->

                                    <a href="{{route('task.edit',$task->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('Company_Admin/dashboard.Edit')"><i class="fa fa-pencil-square-o" style="color:green;"></i></a>

                                    <!--a href="{{route('task.delete',$task->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('Company_Admin/dashboard.Delete')"><i class="fa fa-times" style="color:red;"></i></a-->
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

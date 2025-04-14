@extends('Super_Admin.layouts.admin')

@section('title', 'Worker Types')

@section('content')

  <section class="content">

    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('Super_Admin/dashboard.Worker') @lang('Super_Admin/dashboard.Types') @lang('Super_Admin/dashboard.Management')</h1>
      </div>
      <div class="col-md-4 text-right">
        <a href="{{route('workerTypes.create')}}", class="btn btn-primary btn-sm" style="margin-top: 30px; margin-left: 15px;"><i class="fa fa-plus" aria-hidden="true"></i>@lang('Super_Admin/dashboard.Add') @lang('Super_Admin/dashboard.Worker') @lang('Super_Admin/dashboard.Type') </a>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><b>@lang('Super_Admin/dashboard.List Of All Worker Types')</b></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped table-hover">
              <thead>
              <tr>
                <th class="text-center">@lang('Company_Admin/dashboard.Sr #')</th>
                <th class="text-center">@lang('Super_Admin/dashboard.Name')</th>
                <th class="text-center">@lang('Super_Admin/dashboard.Created On')</th>
                <th class="text-center"></th>
              </tr>
              </thead>
              <tbody>
                @foreach($workers as $key => $worker)
                <tr>
                  <td class="text-center">{{ ++$key }}</td>
                  <td class="text-center">{{ $worker->name }}</td>
                  <td class="text-center">{{ date('M j, Y', strtotime($worker->created_at)) }}</td>
                  <td class="text-center">
                    <h4>
                      <a href="{{route('workerTypes.edit',$worker->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('Super_Admin/dashboard.Edit')"><i class="fa fa-pencil-square-o" style="color:blue;"></i></a>

                      <a href="{{route('workerTypes.delete',$worker->id)}}" onclick="return confirm('Are you sure?')" data-toggle="tooltip" data-placement="top" title="@lang('Super_Admin/dashboard.Delete')"><i class="fa fa-times" style="color:red;"></i></a>
                    </h4>

                  </td>

                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>

@endsection

@section('outer_script')
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('dist/js/demo.js')}}"></script>
<script>

///////////////// Below block is used to localize DataTable data //////////////
 let languageSelected = document.getElementById('languageSwitcher').value;

 if(languageSelected == 'en') {
   $(function () {
     $('#example1').DataTable()
   })

 } else {
   $(function () {
     $('#example1').DataTable({
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

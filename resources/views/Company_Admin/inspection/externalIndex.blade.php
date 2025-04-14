@extends('Company_Admin.layouts.main')

@section('outer_css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
<link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" type="text/css" />

<style>
input[type=checkbox] {
    transform: scale(1.5);
}

[v-cloak] {display: none}
</style>
<link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endsection


@section('title', 'Dashboard')
<div id="wrapper">
  @section('content')
  <div id="app" v-cloak>
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Quality of Projects')</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            @lang('common.Upload external report')
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <div class="">
              <form action="{{ route('uploadReport') }}" enctype="multipart/form-data" method="post">
                @csrf
              <div class="form-group row">
                <div class="col-md-4">
                  <select class="form-control responsive" name="customer_id" v-model="customer" @change="customerChanged" required>
                    <option value="" selected>Select Customer</option>
                    <option v-for="(customer,index) in customers" :value="customer.id">@{{customer.name}}</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <select class="form-control responsive" name="project_id" v-model="project" required>
                    <option value="" selected>Select Project</option>
                    <option v-for="(project,index) in projects" :value="project.id">@{{project.name}}</option>
                  </select>
                </div>

                <div class="col-md-2">
                  <input type="file" class="form-control" name="uploadedFile" accept="application/pdf" required>
                </div>

                <div class="col-md-2">
                  <button class="btn btn-success btn-md" type="submit" name="button">Upload</button>
                </div>

              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            @lang('common.External reports')
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <table width="100%" id="table" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>@lang('Company_Admin/dashboard.Sr #')</th>
                  <th>@lang('common.Customer name')</th>
                  <th>@lang('common.Project name')</th>
                  <th>@lang('common.Upload date')</th>
                  <th data-orderable="false"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($externalReports as $key => $report)
                <tr>
                  <td>{{ ++$key}}</td>
                  <td>{{ $report->project->customer->name }}</td>
                  <td>{{ $report->project->name }}</td>
                  <td>{{ date('M j, Y', strtotime($report->created_at)) }}</td>
                  <td style="text-align:center;">
                    <a href="{{ asset('images/Reports').'/'.$report->pdf_path }}"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;"></i> {{ $report->pdf_path }}</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
  <!-- vue ends here -->
  @endsection
</div>
<!-- wrapper ending here -->


@section('outer_script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('vendor/datatables-responsive/dataTables.responsive.js')}}"></script>

<script src="{{asset('js/lodash.min.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script src="{{asset('js/vue.min.js')}}"></script>
<script src="https://unpkg.com/vue-swal"></script>
<script src="{{asset('js/vue-select-latest.js')}}"></script>
<script src="{{asset('js/InspectionReports/externalIndex.js')}}"></script>

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
</script>
@endsection

<!-- Content Header (Page header) -->

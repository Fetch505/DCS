@extends('Super_Admin.layouts.admin')
@section('content')
  <section class="content">
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Companies Management')</h1>
      </div>
      <div class="col-md-4 text-right">
        <a href="{{route('supadmin.createCompany')}}", class="btn btn-primary btn-sm" style="margin-top: 30px; margin-left: 15px;">@lang('common.Add new')</a>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <div class="row">
              <div class="col-md-4">
                <h3 class="box-title"><b>@lang('common.List of companies')</b></h3>
              </div>
              <div class="col-md-8">
                <h4 style="display: inline; color: green">{{ $active_companies }} Active</h4> | 
                <h4 style="display: inline; color: red">{{ $inactive_companies }} InActive</h4>
              </div>
            </div>

          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>@lang('Company_Admin/dashboard.Sr #')</th>
                <th>@lang('Super_Admin/dashboard.Name')</th>
                <th>@lang('Super_Admin/dashboard.Contact Person')</th>
                <th>@lang('Super_Admin/dashboard.Email')</th>
                <th>@lang('Super_Admin/dashboard.allow_leave_in_app')</th>
                <th>@lang('Super_Admin/dashboard.Phone')</th>
                <th>@lang('Super_Admin/dashboard.Registered On')</th>
                <th>@lang('Super_Admin/dashboard.Last Login')</th>
                <th>@lang('Super_Admin/dashboard.is_active')</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
                @foreach($companies as $key => $company)
                <tr>
                  <td>{{ ++$key }}</td>
                  <td>{{ $company->name }}</td>
                  <td>{{ $company->contact_person1 }}</td>
                  <td>{{ $company->email }}</td>
                  <td>{{ ($company->allow_leaves == 1) ? "True": "False" }}</td>
                  <td>{{ $company->phone }}</td>
                  <td>{{ date('M j, Y', strtotime($company->created_at)) }}</td>
                  <td>{{ $company->lastLoggedIn }}</td>
                  <td>{{ $company->is_active ? 'Active' : 'Not Active' }}</td>
                  <td>
                    <h4>
                      <a href="{{route('supadmin.edit',$company->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('Super_Admin/dashboard.Edit')"><i class="fa fa-pencil-square-o" style="color:blue;"></i></a>

                      {{-- <a href="{{route('supadmin.deleteCompany',$company->id)}}" data-toggle="tooltip" data-placement="top" title="@lang('Super_Admin/dashboard.Delete')"><i class="fa fa-times" style="color:red;"></i></a> --}}
                    </h4>
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

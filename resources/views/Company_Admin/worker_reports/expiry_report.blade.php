<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

</head>

@extends('Company_Admin.layouts.main')

@section('outer_css')
    <style media="screen">
        /* table{
            table-layout: fixed;
            width: 100px;
          } */
    </style>
@endsection

@section('title', 'Dashboard')

<div id="wrapper">

    @section('content')
        <div class="row">
            <div class="col-sm-8">
                <h1 >Expiry Report</h1>
            </div>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row" id="app">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <!--div class="panel-heading">
                        <p>@lang('common.ERP Report') <span> <button style=" float: right;" type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal">Summary Report</button></span></p>
                    </div-->

                    <form action="{{ route('getExpiryReport') }}" method="post">
                        @csrf
                        <div class="row">
                            <br>
                            <div class="col-md-2" >
                                <label for="worker" style="margin-left: 15px;">@lang('Company_Admin/dashboard.Worker'):</label>
                                <select id="worker" name="worker_id"  class="form-control" style="margin-left: 15px; width: 130px;" onchange="populateProjects(this.value)">
                                    <option  selected disabled>Worker</option>
                                    @foreach($worker as $work)
                                        <option value="{{$work->id}}" {{ old('worker_id') == $work->id ? 'selected' : '' }}>{{$work->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2" >
                                <label for="worker">@lang('Company_Admin/dashboard.Project'):</label>
                                <select id="project" name="project_id" class="form-control" style="width: 130px;">
                                    <option  selected disabled>project</option>
                                    @foreach($project as $pro)
                                        <option value="{{$pro->id}}" {{ old('project_id') == $pro->id ? 'selected' : '' }}>{{$pro->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2" >
                                <label for="worker">@lang('Company_Admin/dashboard.Shift'):</label>
                                <select id="shift" name="shift_id" class="form-control" style="width: 130px;">
                                    <option  selected disabled>shift</option>
                                    @foreach($shifts as $shift)
                                        <option value="{{$shift->id}}" {{ old('shift_id') == $shift->id ? 'selected' : '' }}>{{$shift->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="StartTime">Expiry Date:</label><br>
                                <input type="date" id="ExpiryDate" name="StartDate" class="form-control" style="width: 130px;" value="{{old('StartDate')}}">
                            </div>

                            <!--div class="col-md-2">
                                <label for="EndTime">@lang('Company_Admin/dashboard.End Date'):</label><br>
                                <input type="date" id="EndDate" name="EndDate" class="form-control" style="width: 130px;" value="{{old('EndDate')}}">
                            </div-->

                            <div class="col-md-1">
                                <br>
                                <input type="submit" class="form-control btn btn-primary" style="width: 80px; margin-top: 4px;" >
                            </div>
                        </div>
                        <!--div class="row">
                            <br>
                            <div class="col-md-2">
                                <label for="HolidayStartDate" style="margin-left: 15px;">Holiday Start Date:</label><br>
                                <input type="date" id="HolidayStartDate" name="HolidayStartDate" class="form-control" style="margin-left: 15px; width: 130px;">
                            </div>

                            <div class="col-md-2">
                                <label for="HolidayEndDate">Holiday End Date:</label><br>
                                <input type="date" id="HolidayEndDate" name="HolidayEndDate" class="form-control" style="width: 130px;">
                            </div>
                        </div-->    
                           
                    </form>

                    <div class="panel-body">
                        <table width="100%" id="table" class="table table-bordered table-striped table-hover">

                            <thead>
                            <tr>
                                <th>@lang('Company_Admin/dashboard.Employee Code')</th>
                                <th>@lang('Company_Admin/dashboard.Worker Name')</th>
                                <th>@lang('Company_Admin/dashboard.Project')</th>
                                <th>Visa Expiry</th>
                                <th>Passport Expiry</th>
                                <th>Health Card Expiry</th>                                
                                <!--th>@lang('Company_Admin/dashboard.Task Name')</th-->                                
                                <!--th>@lang('Company_Admin/dashboard.Shift')</th-->                                
                                <!--th>@lang('Company_Admin/dashboard.Date')</th>
                                <th>@lang('Company_Admin/dashboard.Start Time')</th>
                                <th>@lang('Company_Admin/dashboard.End Time')</th-->
                                <!--th>Hours</th-->
                                <!--th>@lang('Company_Admin/dashboard.Break')</th-->
                                <!--th>Receiving Order</th-->
                                <!--th>Overtime</th-->
                            </tr>
                            </thead>

                            <tbody>
                            @if(session('worker_report'))
                                @foreach(session('worker_report') as $key => $detail)
                                    <tr>
                                    
                                        <td>{{ optional($detail)->employee_code }}</td>
                                        <td>{{ $detail->name }}</td>
                                        <td>{{ $detail->Project }}</td>
                                        <td>{{ $detail->visa_expiry_date }}</td>
                                        <td>{{ $detail->passport_expiry_date }}</td>
                                        <td>{{ optional($detail)->health_card_expiry_date }}</td>
                                        <!--td>{{ optional($detail)->project_code }}</td-->                                        
                                       
                                    </tr>
                                @endforeach

                            @else

                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <!--div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Summary Report</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body">
                            <table width="100%" id="tables" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>@lang('Company_Admin/dashboard.Worker Name')</th>
                                    <th>@lang('Company_Admin/dashboard.Project name')</th>
                                    <th>@lang('Company_Admin/dashboard.Task Name')</th>
                                    <th>@lang('Company_Admin/dashboard.Total Time')</th>
                                    <th>@lang('Company_Admin/dashboard.Location')</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(session('worker_report'))

                                    @foreach(session('summary_report') as $key => $detail)
                                        <tr>
                                            <td>{{ $detail->worker_name }} in summary</td>
                                            <td>{{ $detail->project_name }}</td>
                                            <td>{{ $detail->tasks_name }}</td>
                                            <td>{{ $detail->total_time }}</td>
                                            <td>{{ $detail->location_name }}</td>
                                        </tr>
                                    @endforeach

                                @elseif(session('worker_report'))

                                    @foreach(session('worker_report') as $key => $detail)
                                        <tr>
                                            <td>{{ $detail->worker_name }} in worker</td>
                                            <td>{{ $detail->project_name }}</td>
                                            <td>{{ $detail->tasks_name }}</td>
                                            <td>{{ $detail->total_time }}</td>
                                            <td>{{ $detail->location_name }}</td>
                                        </tr>
                                    @endforeach

                                @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div-->
    @endsection
</div>



@section('outer_script')

    <script src="{{asset('public/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/js/worker_report.js')}}"></script>


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

    <script>

        $(document).ready(function(){
            $("#asad").click(function(e){



            });
        });
        ///////////////// Below block is used to localize DataTable data //////////////
        let languageSelected = document.getElementById('languageSwitcher').value;
        function getWorkerData(){

        }

        // Call populateProjects() when the page is loaded with old inputs
        document.addEventListener('DOMContentLoaded', function() {
            var workerId = "{{ old('worker_id') }}";
            if (workerId) {
                populateProjects(workerId);
            }
        });

        //get projects for worker
        function populateProjects(workerId) {
            var projectId = "{{ old('project_id') }}";

            $.ajax({
                url: APP_URL + '/getprojectsforworker/' + workerId,
                method: 'GET',
                success: function(response) {
                    //console.log(response);
                    var projects = response;
                    // Create a variable to hold the HTML options
                    var options = '';

                    // Iterate through the projects array and add options to the HTML string
                    $.each(projects, function(index, project) {
                        var selected = (project.id == projectId) ? 'selected' : '';
                        options += '<option value="' + project.id + '" ' + selected + '>' + project.name + '</option>';
                    });

                    // Set the HTML of the project select element to the options string
                    $('#project').html(options);

                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        }
        if(languageSelected == 'en') {
            $(document).ready(function () {
                $('#table,#tables').DataTable({
                    responsive: true,


                    dom: '<"html5buttons"B>lTfgitp',
                    order: [0, 'desc'],
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        // 'csvHtml5',
                        'pdfHtml5',
                        'print',

                    ]

                });

            });

        }
        else {
            $(function () {
                $('#table,#tables').DataTable({
                    dom: '<"html5buttons"B>lTfgitp',
                    order: [0, 'desc'],
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        // 'csvHtml5',
                        'pdfHtml5',
                        'print',

                    ],


                    language: {

                        WorkerReport :"Uren overzicht",
                        ListOfWorker: "Remove it",
                        ChooseAWorker:"Selecteer de medewerker",
                        Worker : "Medewerker",
                        ChooseAProject: "Slecteer de project",
                        WorkerName: "Naam medewerker",
                        ProjectName: "Naam project",
                        TaskName: "Taak",
                        Start: "Start",
                        Date: "Datum",
                        Time: "Tijd",




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

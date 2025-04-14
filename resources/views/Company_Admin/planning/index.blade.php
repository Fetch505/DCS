@extends('Company_Admin.layouts.main')

@section('outer_css')
    <style media="screen">
    </style>
    <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">
    <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('title', 'Dashboard')

<div id="wrapper">

    @section('content')
        <input type="hidden" ref="language" value="{{App::getLocale()}}">
        <div class="row">
            <div class="col-sm-8">
                <h1 >@lang('common.Worker Planning Management') </h1>
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
                    <div class="panel-heading">
                    
                    <div class="row">
                        <br>
                        <div class="col-md-4">
                            <form id="projectForm" action="{{ url('getProjectWorkers') }}" method="post">
                            @csrf
                                <label for="project" style="margin-left: 15px;">@lang('Company_Admin/dashboard.Choose a project'):</label>
                                <select id="project" name="project_id" class="form-control" style="margin-left: 15px; width: 200px;">
                                    <option  selected disabled>project</option>
                                    <option value="0" {{ old('project_id') == "0" ? 'selected' : '' }}>@lang('Company_Admin/dashboard.Unassigned')</option>
                                    @foreach($projects as $pro)
                                        <option value="{{$pro->id}}" {{ old('project_id') == $pro->id ? 'selected' : '' }}>{{$pro->name}}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>

                        <div class="col-md-3">
                            <br>
                            <h4>Selected Workers: <span>@{{ selectedWorkers.length }}</span></h4>
                        </div>

                        <div id="floating" class="col-md-5 text-right">
                            <br>
                            <button id="unassign" class="btn btn-primary" @click="handleUnassign" :disabled="selectedWorkers.length === 0 || selectedProject === 0">Unssign Workers</button>
                            <button id="transfer" class="btn btn-info " data-toggle="modal" data-target="#addJob" style="margin-right: 15px;" :disabled="selectedWorkers.length === 0">Assign to new Project</button>
                        </div>
                    </div>
                    </div>

                    <div class="panel-body">
                        <table width="100%" id="table" class="table table-bordered table-striped table-hover">

                            <thead>
                            <tr>
                                <th></th>
                                <th>@lang('Company_Admin/dashboard.Employee Code')</th>
                                <th>@lang('Company_Admin/dashboard.Worker Name')</th>
                                @if(old('project_id') == "0")
                                    <th>@lang('Company_Admin/dashboard.Vacation')</th>
                                @else
                                    <th>@lang('Company_Admin/dashboard.Project name')</th>
                                    <th>@lang('Company_Admin/dashboard.Task Name')</th>
                                @endif
                                <th>@lang('Company_Admin/dashboard.Leave')</th>
                                <th>@lang('Company_Admin/dashboard.Resigned')</th>

                            </tr>
                            </thead>

                            <tbody>
                            @if(session('workers'))
                                @foreach(session('workers') as $key => $worker)
                                    <tr>
                                        <td>
                                            <input
                                                type="checkbox"
                                                class="worker-checkbox"
                                                data-worker="{{ json_encode($worker) }}"
                                                @change="toggleWorkerSelection($event)"
                                            >
                                        </td>
                                        <td>{{ $worker->employee_code }}</td>
                                        <td>{{ $worker->worker_name }}</td>
                                        @if(old('project_id') == "0")
                                            <td>{{ $worker->start_date ?: '' }} - {{ $worker->end_date ?: '' }}</td>
                                        @else
                                            <td>{{ $worker->project_name ?: '' }}</td>
                                            <td>{{ $worker->tasks_name ?: '' }}</td>
                                        @endif
                                        <td>{{ $worker->leave_details }}</td>
                                        <td>{{ $worker->resign_date ?: '' }}</td>
                                    </tr>
                                @endforeach
                            
                            @else

                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
            <!-- Add new Job Modal -->
            <div class="modal fade" id="addJob" role="dialog" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" @click.prevent="closeAddModel">&times;</button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group row">
                            <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Project') :*</label>
                            <div class="col-md-8">
                                <v-select :options="projects" label="name" v-model="addJob.project" placeholder="@lang('Company_Admin/dashboard.Project')" style="width:100%;"></v-select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Floor') :*</label>
                            <div class="col-md-8">
                                <v-select :options="floors" label="name" v-model="addJob.floor" placeholder="@lang('Company_Admin/dashboard.Floor Type')" style="width:100%;"></v-select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Space type'):*</label>
                            <div class="col-md-8">
                                <v-select :options="areas" label="name" v-model="addJob.area" placeholder="@lang('Company_Admin/dashboard.Space type')">
                                </v-select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Element'):*</label>
                            <div class="col-md-8">
                                <v-select :options="elements" label="name" v-model="addJob.element" placeholder="@lang('Company_Admin/dashboard.Select Element')" @input="elementChanged">
                                </v-select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Task'):*</label>
                            <div class="col-md-8">
                                <v-select :options="tasks" label="name" v-model="addJob.task" placeholder="@lang('Company_Admin/dashboard.Select Task')">
                                </v-select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Type'):*</label>
                            <div class="col-md-8">
                                <select class="form-control clean_type" v-model="addJob.type" placeholder="@lang('Company_Admin/dashboard.Select type')">
                                <option :value="type" v-for="(type, key) in types">@{{ type }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" v-if="addJob.type === 'Daily' || addJob.type === 'Dagelijks' ">
                            <div class="col-md-10 col-md-offset-2">
                                @lang('Company_Admin/dashboard.Mon'): <input class="N" type="checkbox" v-model="addJob.mon">
                                @lang('Company_Admin/dashboard.Tue'): <input class="N" type="checkbox" v-model="addJob.tue">
                                @lang('Company_Admin/dashboard.Wed'): <input class="N" type="checkbox" v-model="addJob.wed">
                                @lang('Company_Admin/dashboard.Thur'):<input class="N" type="checkbox" v-model="addJob.thu">
                                @lang('Company_Admin/dashboard.Fri'): <input class="N" type="checkbox" v-model="addJob.fri">
                                @lang('Company_Admin/dashboard.Sat'): <input class="N" type="checkbox" v-model="addJob.sat">
                                @lang('Company_Admin/dashboard.Sun'): <input class="N" type="checkbox" v-model="addJob.sun">
                            </div>
                        </div>
                        
                        <div class="form-group row" v-else-if="addJob.type === 'Weekly' || addJob.type === 'Wekelijks'">
                            <div class="col-md-10 col-md-offset-2" style="width: 67%;">
                                <v-select :options="total_weeks" multiple v-model="addJob.selected_weeks" placeholder="@lang('Company_Admin/dashboard.Select week number')">
                                </v-select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-primary" @click.prevent="assignJob">@lang('Company_Admin/dashboard.Add')</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal" @click.prevent="closeAddModel">@lang('Company_Admin/dashboard.Cancel')</button>
                    </div>
                    <br>

                </div>
            </div>
        </div>
    @endsection
</div>



@section('outer_script')

    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
    <script>
        var initialData = @json($jobData);
        var selectedProjectId = document.getElementById('project').value;
        console.log(selectedProjectId);
    </script>
    <script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('js/lodash.min.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/vue-select-latest.js')}}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script> --}}
    <script src="{{asset('js/vue.min.js')}}"></script>
    <script type="text/javascript"></script>
    <script src="https://unpkg.com/vue-swal"></script>
    <script src="{{asset('js/planning.js')}}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>       
    
    <script>

        let languageSelected = document.getElementById('languageSwitcher').value;
        
        const projectSelect = document.getElementById('project');
        const projectForm = document.getElementById('projectForm');
        const unassignButton = document.getElementById("unassign");

        document.addEventListener('DOMContentLoaded', function() {
            if (projectSelect === "0") {
                unassignButton.style.display = "none";
            }
        });

        projectSelect.addEventListener('change', function() {
            projectForm.submit();
        });

        if(languageSelected == 'en') {
            $(document).ready(function () {
                $('#table,#tables').DataTable({
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    order: [0, 'desc'],
                    select: {
                        style: 'multi',
                        selector: '.worker-checkbox'
                    }
                });
            });
        }
        else {
            $(function () {
                $('#table,#tables').DataTable({
                    dom: '<"html5buttons"B>lTfgitp',
                    order: [0, 'desc'],
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
                    },
                    select: {
                        style: 'multi',
                        selector: '.worker-checkbox'
                    }
                })
            })
        }
    </script>
@endsection

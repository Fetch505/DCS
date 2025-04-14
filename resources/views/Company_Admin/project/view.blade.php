@extends('Company_Admin.layouts.main')

@section('title', 'Dashboard')
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>

  <div id="wrapper">
   <!-- <div id="app"> -->
    @section('content')
<div id="app">
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Projects Management')</h1>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
          <a class="btn btn-primary btn-md pull-right" href="{{route('project.index')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Back')</a>
            <div class="panel panel-info">
                <div class="panel-heading">
                    @lang('common.Project details')
                </div>
                <div class="panel-body">
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Name') :</label>
                      <span style="position: absolute; left: 150px;">{{$project->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Description') :</label>
                      <span style="position: absolute; left: 150px;">{{$project->description}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Customer') :</label>
                      <span style="position: absolute; left: 150px;">{{$project->customer->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Supervisor') :</label>
                      <span style="position: absolute; left: 150px;">{{($project->projectSupervisor)? $project->projectSupervisor->name : ''}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Inspector') :</label>
                      <span style="position: absolute; left: 150px;">{{($project->projectInspector)? $project->projectInspector->name : ''}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Workers') :</label>
                      <span style="position: absolute; left: 150px;">{{($totalWorkers)? $totalWorkers : '0'}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Phone') :</label>
                      <span style="position: absolute; left: 150px;">{{$project->phone}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Address') :</label>
                      <span style="position: absolute; left: 150px;">{{$project->address}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Country') :</label>
                      <span style="position: absolute; left: 150px;">{{$project->country}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Start Date') :</label>
                      <span style="position: absolute; left: 150px;">{{ date('M j, Y', strtotime($project->start_date)) }}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.End Date') :</label>
                      <span style="position: absolute; left: 150px;">{{ date('M j, Y', strtotime($project->end_date)) }}</span>
                    </div>
                    <br>

                    <div class="inline">
                      <label for="name"><strong>@lang('Company_Admin/dashboard.Locations') :</strong></label>
                      <ul style="padding-left:150px; list-style-type:square">
                        @foreach ($project->locations as $location)
                          <li> <i>{{$location->name}}</i> </li>
                        @endforeach
                      </ul>
                    </div>

                  </div>
            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <button class="btn btn-danger pull-right"
            @click.prevent="showAllJobs = true" role="button" >@lang('Company_Admin/dashboard.show_all_Jobs')</button>

            <button class="btn btn-success pull-right" @click.prevent="showAllJobs = false" role="button" >@lang('Company_Admin/dashboard.filter_jobs')</button>
        </div>
      </div>
      <br>
      <input type="hidden" value="{{$project->id}}" ref="proj_id">

      <div class="row">
        <div class="panel panel-primary">
          <div class="panel-heading inline">
            <label for="name"><strong>@lang('Company_Admin/dashboard.Work Program') :</strong></label>

            <a class="btn btn-md btn-danger pull-right" name="button" href="{{route('projectAllJobPdf',$project->id)}}"><i class="far fa-file-pdf"></i> @lang('Company_Admin/dashboard.Download') PDF</a>
          </div>

          <div class="panel-body table-responsive">
            @foreach($project->jobs as $key=>$job)
              <h4>{{$job->floor->name}}</h4>
            <table width="100%" id="table" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>@lang('Company_Admin/dashboard.Area')</th>
                  <th>@lang('Company_Admin/dashboard.Worker')</th>
                  <th>@lang('Company_Admin/dashboard.Location')</th>
                  <th>@lang('Company_Admin/dashboard.Element')</th>
                  <th>@lang('Company_Admin/dashboard.Task')</th>
                  <th>@lang('Company_Admin/dashboard.Type')</th>
                  <th>@lang('Company_Admin/dashboard.Mon')</th>
                  <th>@lang('Company_Admin/dashboard.Tue')</th>
                  <th>@lang('Company_Admin/dashboard.Wed')</th>
                  <th>@lang('Company_Admin/dashboard.Thur')</th>
                  <th>@lang('Company_Admin/dashboard.Fri')</th>
                  <th>@lang('Company_Admin/dashboard.Sat')</th>
                  <th>@lang('Company_Admin/dashboard.Sun')</th>
                </tr>
              </thead>
              <tbody>
                @foreach($job->days as $key => $day)
                  @if($day->status == 1)
                    <tr>
                      <td>{{$day->area->name}}</td>
                      <td>{{$day->user->name}}</td>
                      <td>{{$day->location['name']}}</td>
                      <td>{{$day->element->name}}</td>
                      <td>{{$day->task->name}}</td>
                      <td>{{$day->type}}</td>
                      <td>{{($day->mon == "1") ? 'X':''}}</td>
                      <td>{{($day->tue == "1") ? 'X':''}}</td>
                      <td>{{($day->wed == "1") ? 'X':''}}</td>
                      <td>{{($day->thu == "1") ? 'X':''}}</td>
                      <td>{{($day->fri == "1") ? 'X':''}}</td>
                      <td>{{($day->sat == "1") ? 'X':''}}</td>
                      <td>{{($day->sun == "1") ? 'X':''}}</td>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
            @endforeach
          </div>
        </div>
      </div>

      <div class="row">
        <div class="panel panel-primary">
          <div class="panel-heading inline">
            <label for="name"><strong>@lang('Company_Admin/dashboard.Materials') :</strong></label>
            <div class="pull-right">
              <a href="{{ route('project.assign-materials', ['projectId' => $project->id]) }}"  name="button" class="btn btn-success">@lang('Company_Admin/dashboard.Add') @lang('Company_Admin/dashboard.Material')</a>
              <a href="{{ route('project.material-transactions', ['projectId' => $project->id]) }}"  name="button" class="btn btn-success">@lang('Company_Admin/dashboard.Transactions') </a>
            </div>
          </div>

          <div class="panel-body table-responsive">
            <table width="100%" id="table" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>@lang('Company_Admin/dashboard.Sr #')</th>
                  <th>@lang('common.Category')</th>
                  <th>@lang('Company_Admin/dashboard.Type')</th>
                  <th>@lang('Company_Admin/dashboard.Name')</th>
                  <th>@lang('Company_Admin/dashboard.Stock')</th>
                  <th>@lang('Assigned Users')</th>
                </tr>
              </thead>
              <tbody>
                @foreach($project->materials as $key =>$material)
                  <tr>
                    <td>{{ ++$key}}</td>
                    <td>{{ $material->materialType->materialCategory->name }}</td>
                    <td>{{ $material->materialType->name }}</td>
                    <td>{{ $material->name }}</td>
                    <td>{{ $material->pivot->quantity }}</td>
                    <td>
                      @if($material->materialType->materialCategory->consumable)
                        <i title="consumable item" class="fa fa-tint" style="color:green;"></i>
                      @else
                        <a href="{{ route('material.assign-users', ['projectId' => $project->id, 'materialId' => $material->id]) }}"><i class="fa fa-plus" style="color:blue;"></i></a>
                        <a href="#" title="View Details" class="view-icon" data-toggle="modal" data-target="#assignedUsersModal" onclick="showAssignedUsers('{{ $key }}')">
                          <i class="fa fa-eye view-icon" style="color:blue"></i>
                        </a>
                      @endif
                    </td>
                  </tr>
                  <tr class="assigned-users-row" id="assignedUsersRow{{ $key }}" style="display: none;">
                    <td colspan="6">
                      <table class="table">
                        <tbody>
                          @foreach($material->assignedUsers as $userKey => $user)
                          <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->pivot->usage_limit }} days</td>
                            <td>{{ $user->pivot->quantity }}</td>
                            <td>{{ $user->pivot->created_at->format('Y-m-d') }}</td>
                            @if($material->materialType->materialCategory->has_usage_limit)
                              <td style="color: red;">{{ $user->pivot->created_at->addDays($user->pivot->usage_limit)->format('Y-m-d') }}</td>
                            @endif
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>


          </div>
        </div>
      </div>

      
            

            <!-- Modal -->
            <div class="modal fade" id="assignedUsersModal" tabindex="-1" role="dialog" aria-labelledby="assignedUsersModalLabel">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="assignedUsersModalLabel">Assigned Users</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <table class="table">
                        <thead>
                          <tr>
                          <th>@lang('Company_Admin/dashboard.User') @lang('Company_Admin/dashboard.Name')</th>
                            <th>@lang('Company_Admin/dashboard.Usage')</th>
                            <th>@lang('Company_Admin/dashboard.Quantity')</th>
                            <th>@lang('Company_Admin/dashboard.Assign') @lang('Company_Admin/dashboard.Date')</th>
                            <th>@lang('Company_Admin/dashboard.Expiry') @lang('Company_Admin/dashboard.Date')</th>
                          </tr>
                        </thead>
                        <tbody id="assignedUsersTableBody">
                          <!-- Assigned users will be displayed here -->
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
            </div>

    </div>
    @endsection
</div>

  @section('outer_script')
    <script src="{{asset('public/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('public/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
    <script src="{{asset('public/dist2/js/sb-admin-2.js')}}"></script>
    <script src="{{asset('public/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('public/js/lodash.min.js')}}"></script>
    <script src="{{asset('public/js/axios.min.js')}}"></script>
    <script src="{{asset('public/js/vue.min.js')}}"></script>
    <script src="{{asset('public/js/vue-select-latest.js')}}"></script>
    <script src="{{asset('public/js/view_project.js')}}"></script>
    <script>
  function showAssignedUsers(rowId) {
    $('#assignedUsersTableBody').empty();
    
    // Find the hidden row containing assigned users for the clicked row
    var assignedUsersRow = $('#assignedUsersRow' + rowId);
    
    // Clone the contents of the hidden row and append them to the modal table body
    $('#assignedUsersTableBody').append(assignedUsersRow.find('tbody').html());
  }
</script>
  
  <script>

  ///////////////// Below block is used to localize DataTable data //////////////
   let languageSelected = document.getElementById('languageSwitcher').value;

   if(languageSelected == 'en') {
     $(function () {
       $('.table').DataTable()
     })

   } else {
     $(function () {
       $('.table').DataTable({
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

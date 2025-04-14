@extends('Company_Admin.layouts.main')

@section('outer_css')
<style src="{{asset('select2/dist/css/select2.min.css')}}"></style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
<link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" type="text/css" />
<style>
[v-cloak] {
  display: none;
}

input[type=checkbox] {
    transform: scale(1.5);
}
input[type=radio] {
    transform: scale(1.5);
}

#map {
  height: 100%;
}
.controls {
  margin-top: 10px;
  border: 1px solid transparent;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 32px;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 300px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

.pac-container {
  font-family: Roboto;
}

#type-selector {
  color: #fff;
  background-color: #4d90fe;
  padding: 5px 11px 0px 11px;
}

#type-selector label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}
table{
  table-layout: auto;
  width: 100%;
  border: 1px solid;
}
tr{
  border: 1px solid;
}
td {
  border: 1px solid;
  text-align: center;
}
th {
  border: 1px solid;
  border-bottom: 1px solid;
}
thead {
  border: 1px solid;
}
</style>
<link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endsection


@section('title', 'Dashboard')

<div id="wrapper">
  @section('content')
  <div id="add_project" v-cloak>
  <input type="hidden" ref="language" value="{{App::getLocale()}}">
  <div class="row">
    <div class="col-sm-8">
      <h1>@lang('common.Projects Management')</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          @lang('common.Add new project')
        </div>
        <div class="panel-body">
          <div class="">
            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Name'):*</label>
              <div class="col-md-8">
                <input class="form-control" type="text" v-model:value="project.name">
                <span style="color:red;" v-if="errors.name">@{{errors.name[0]}}</span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Description'):*</label>
              <div class="col-md-8">
                <input class="form-control" type="text" v-model:value="project.desc">
                <span style="color:red;" v-if="errors.description">@{{errors.description[0]}}</span>
              </div>
            </div>

            <!--div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Customer'):*</label>
              <div class="col-md-8">
                <select class="form-control customers" v-model="project.customer_id">
                  <option value="" disabled>@lang('Company_Admin/dashboard.Select') @lang('Company_Admin/dashboard.Customer')</option>
                  <option v-for="customer in customers"  :value="customer.id">@{{ customer.name }}</option>
                </select>
                <span style="color:red;" v-if="errors.customer_id">@{{errors.customer_id[0]}}</span>
              </div>
            </div-->

            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Customer'):*</label>
              <div class="col-md-8">
                  <v-select v-model="project.customer_id" :options="customers" label="name" placeholder="@lang('Company_Admin/dashboard.Select') @lang('Company_Admin/dashboard.Customer')" :searchable="true"></v-select>
                <span style="color:red;" v-if="errors.customer_id">@{{errors.customer_id[0]}}</span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Supervisor'):*</label>
              <div class="col-md-8">
                <select class="form-control supervisors" v-model="project.supervisor_id" @change.prevent="supervisorChanged">
                  <option value="" disabled>@lang('Company_Admin/dashboard.Select') @lang('Company_Admin/dashboard.Supervisor')</option>
                  <option v-for="supervisor in supervisors"  :value="supervisor.id">@{{ supervisor.name }}</option>
                </select>
                <span style="color:red;" v-if="errors.supervisor_id">@{{errors.supervisor_id[0]}}</span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Inspector'):*</label>
              <div class="col-md-8">
                <select class="form-control inspectors" v-model="project.inspector_id">
                  <option value="" disabled>@lang('Company_Admin/dashboard.Select') @lang('Company_Admin/dashboard.Inspector')</option>
                  <option v-for="inspector in inspectors"  :value="inspector.id">@{{ inspector.name }}</option>
                </select>
                <span style="color:red;" v-if="errors.inspector_id">@{{errors.inspector_id[0]}}</span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Phone'):*</label>
              <div class="col-md-8">
                   <vue-phone-number-input default-country-code="NL" @update="onUpdate" dark-color="#424242" clearable required v-model="project.phone"/>
                <!--<input class="form-control" type="text" v-model:value="project.phone">-->
                <span style="color:red;" v-if="errors.phone">@{{errors.phone[0]}}</span>
              </div>
            </div>
            <div>
            </div>

            {{-- <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Country'):*</label>
              <div class="col-md-8">
                <input class="form-control" disabled type="text" v-model:value="project.country">
                <span style="color:red;" v-if="errors.country">@{{errors.country[0]}}</span>
              </div>
            </div> --}}
            <!-- Remove Post Code API -->
            <!--div class="form-group row">
              <div class="col-md-4">
                <label class="col-md-4" for="">@lang('Company_Admin/dashboard.Post code'):*</label>
                <div class="col-md-6 pull-right">
                  <input class="form-control"
                  style="padding-left: 18px;" type="text"
                  v-model:value="project.postcode"
                  v-on:keyup.enter="getAddress"
                  v-on:change="project.address=''; project.city=''"
                  required>
                  <span style="color:red;" v-if="errors.postcode">@{{errors.postcode[0]}}</span>
                </div>
              </div-->
              <!--div class="form-group row">
                <div class="col-md-4">
                  <label class="col-md-4" for="">@lang('Company_Admin/dashboard.Post code'):*</label>
                  <div class="col-md-6 pull-right">
                    <input class="form-control"
                    style="padding-left: 18px;" type="text"
                    v-model:value="project.postcode"
                    required>
                    <span style="color:red;" v-if="errors.postcode">@{{errors.postcode[0]}}</span>
                  </div>
                </div-->
              <!--Remove Post Code API-->
              <!--div class="col-md-4" style="">
                <label class="col-md-6" for="">@lang('common.House Number'):*</label>
                <div class="col-md-6">
                  <input class="form-control" type="number"
                  v-model:value="project.houseNumber"
                  v-on:keyup.enter="getAddress"
                  v-on:change="project.address=''; project.city=''"
                  required>
                  <span style="color:red;" v-if="errors.houseNumber">@{{errors.houseNumber[0]}}</span>
                </div>
              </div-->
              <!--div class="col-md-4" style="">
                <label class="col-md-6" for="">@lang('common.House Number'):*</label>
                <div class="col-md-6">
                  <input class="form-control" type="number"
                  v-model:value="project.houseNumber"
                  required>
                  <span style="color:red;" v-if="errors.houseNumber">@{{errors.houseNumber[0]}}</span>
                </div>
              </div-->
              <!--div class="col-md-2" style="">
                <!-- <span style="color:blue;" v-if="project.houseNumber && project.postcode">@lang('common.Press enter')</span> -->

                <!-- <button class="btn btn-success btn-md" type="button" name="button" @click.prevent="getAddress"><i class="fa fa-arrow-circle-right"></i></button> -->
              <!--/div-->
            <!--/div-->

            <!--div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Address'):*</label>
              <div class="col-md-8">
              <input class="form-control" type="text" v-model:value="project.address">
              <span style="color:red;" v-if="errors.address">@{{errors.address[0]}}</span>
              </div>
            </div-->

            <!--div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.City'):*</label>
              <div class="col-md-8">
                <input class="form-control" type="text" v-model:value="project.city">
                <span style="color:red;" v-if="errors.city">@{{errors.city[0]}}</span>
              </div>
            </div-->

            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Start Date'):*</label>
              <div class="col-md-8">
                <input class="form-control" id="startDate" v-model:value="project.start_date" placeholder="dd/mm/yy">
                <span style="color:red;" v-if="errors.start_date">@{{errors.start_date[0]}}</span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.End Date'):*</label>
              <div class="col-md-8">
                <input class="form-control" id="endDate" placeholder="dd/mm/yy" v-model:value="project.end_date">
                <span style="color:red;" v-if="errors.end_date">@{{errors.end_date[0]}}</span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Break'):</label>
              <div class="col-md-8">
                <input class="form-control" id="break" placeholder="Time in minutes"  type="number" v-model:value="project.break" min="0">
                <span style="color:red;" v-if="errors.break">@{{errors.break[0]}}</span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Code'):</label>
              <div class="col-md-8">
                <input class="form-control" id="code" placeholder="Project Code"  type="number" v-model:value="project.code" min="0">
                <span style="color:red;" v-if="errors.break">@{{errors.code[0]}}</span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Notes'):</label>
              <div class="col-md-8">
                <textarea id="notes" class="form-control" type="text" v-model:value="project.notes"></textarea>
                <span style="color:red;" v-if="errors.notes">@{{errors.notes[0]}}</span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Locations'):*</label>
              <!-- <div class="row col-md-16"> -->
                <div class="col-md-9 table-responsive">
                  <div id="map" style="height: 300px; width: 500px"></div>
                  <div id="type-selector" class="controls col-md-2">
                    <input type="radio" name="type" id="changetype-all" checked="checked">
                    <label for="changetype-all">All</label>
                  </div>
                  <input id="pac-input" class="controls" type="text" placeholder="Enter a location" :disabled="isInputDisabled">
                </div>
                <div class="col-md-2" v-show="locations.length > 0">
                  <button href="#" class="btn btn-info btn-md" title="Add field" @click.prevent="addMoreLocation">+ @lang('Company_Admin/dashboard.Add Location')</button>
                </div>
              <!-- </div> -->
            </div>

            <div class="form-group row">
              <div class="col-md-6 col-md-offset-2">
                <div class="panel panel-default" v-show="locations.length > 0 && !tempJobs.length">
                    <div class="panel-heading">
                        @lang('Company_Admin/dashboard.Locations')
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                              <thead>
                                <th>@lang('Company_Admin/dashboard.Locations')</th>
                                <th></th>
                              </thead>
                              <tbody>
                                <tr v-for="(location,index) in locations">
                                  <td>@{{location.name}}</td>
                                  <td> <button type="button" class="btn btn-danger btn-md" name="button" @click.prevent="removeLocation(index)"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-10">
                <button id="tasks_modal" type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#tasks" data-whatever="@mdo">@lang('Company_Admin/dashboard.add_tasks')</button>
              </div>
            </div>

            <template v-if="tempJobs.length > 0">
              <div class="form-group row">
                <div class="col-md-12 table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                      <tr>
                        <th>@lang('Company_Admin/dashboard.Floor')</th>
                        <th>@lang('Company_Admin/dashboard.Area')</th>
                        <th>@lang('Company_Admin/dashboard.Worker')</th>
                        <th>@lang('Company_Admin/dashboard.Element')</th>
                        <!--th>@lang('Company_Admin/dashboard.Element_type')</th-->
                        <th style="width:10px;">@lang('Company_Admin/dashboard.Task')</th>
                        <th>@lang('Company_Admin/dashboard.Type')</th>
                        <th>@lang('common.Weeks')</th>
                        <th>@lang('Company_Admin/dashboard.Mon')</th>
                        <th>@lang('Company_Admin/dashboard.Tue')</th>
                        <th>@lang('Company_Admin/dashboard.Wed')</th>
                        <th>@lang('Company_Admin/dashboard.Thur')</th>
                        <th>@lang('Company_Admin/dashboard.Fri')</th>
                        <th>@lang('Company_Admin/dashboard.Sat')</th>
                        <th>@lang('Company_Admin/dashboard.Sun')</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody class="days_grid">
                      <tr v-for="(job, key) in tempJobs">
                        <td>@{{ job.floor_name }}</td>
                        <td>@{{ job.area_name }}</td>
                        <td>@{{ job.worker_name }}</td>
                        <td>@{{ job.element_name }}</td>
                        <!--td>@{{ job.element_type_name }}</td-->
                        <td>@{{ job.task_name }}</td>
                        <template v-if="language === 'en'">
                          <td>@{{ job.type }}</td>
                        </template>
                        <template v-else>
                          <td v-if="job.type === 'daily'">dagelijks</td>
                          <td v-if="job.type === 'weekly'">wekelijks</td>
                          <td v-if="job.type === 'one-time'">Eenmalig</td>
                          <td v-if="job.type === 'extra'">Extra</td>
                        </template>
                        <template v-if="job.type === 'weekly'">
                          <template v-for="week in job.week_number">
                            <span class="badge badge-pill badge-success">@{{ week }}</span>
                          </template>
                        </template>
                        <template v-else>
                          <td></td>
                        </template>
                        <td>@{{ job.mon ? 'X':'' }}</td>
                        <td>@{{ job.tue ? 'X':'' }}</td>
                        <td>@{{ job.wed ? 'X':'' }}</td>
                        <td>@{{ job.thu ? 'X':'' }}</td>
                        <td>@{{ job.fri ? 'X':'' }}</td>
                        <td>@{{ job.sat ? 'X':'' }}</td>
                        <td>@{{ job.sun ? 'X':'' }}</td>
                        <td>
                          <a href="#" class=" btn btn-danger btn-sm" @click.prevent="removeNewJob(key)"><i class="fa fa-times"></i> @lang('Company_Admin/dashboard.Delete')</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </template>

            <div class="inline pull-right">
              <button type="button" class="btn btn-success" @click.prevent="createProject">@lang('Company_Admin/dashboard.Create')</button>
              <a href="{{ route('project.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="tasks" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" @click.prevent ='modalClosed' aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Floor'):*</label>
            <div class="col-md-8">
              <v-select :options="floors" label="name" v-model="job.floor_id" placeholder="@lang('Company_Admin/dashboard.Select Floor')">
              </v-select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Space type'):*</label>
            <div class="col-md-8">
              <template>
                <v-select :options="areas" label="name" v-model="job.area_id" placeholder="@lang('Company_Admin/dashboard.Select area')">
                </v-select>
              </template>

          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Location'):*</label>
          <div class="col-md-8">
            <v-select :options="locations" label="name" v-model="job.location">
            </v-select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Worker Name'):*</label>
          <div class="col-md-8">
            <v-select :options="workers" label="label" v-model="job.worker_id" placeholder="@lang('Company_Admin/dashboard.Select Worker')">
            </v-select>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Element'):*</label>
        <div class="col-md-8">
          <v-select :options="elements" label="displayName" v-model="job.element_id" placeholder="@lang('Company_Admin/dashboard.Select Element')" @input="elementChanged">
          </v-select>
      </div>
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" @click="showNewElementForm = true">
          <i class="fa fa-plus"></i>
        </button>
      </div>
    </div>

    <!-- New element form -->
    <div v-if="showNewElementForm">
      <div class="form-group row">
        <label class="col-md-2" for="">New @lang('Company_Admin/dashboard.Element'):*</label>
        <div class="col-md-8">
          <input type="text" class="form-control" v-model="newElementName" required>
          <span v-if="!newElementName" class="text-danger">Element name is required</span>
        </div>
      </div>
      <div class="form-group row">
      <label class="col-md-2" for="">New @lang('Company_Admin/dashboard.Task'):*</label>
        <div class="col-md-8">
          <input type="text" class="form-control" v-model="newTaskName" required>
          <span v-if="!newTaskName" class="text-danger">Task name is required</span>
        </div>
      </div>
    <div class="form-group row">
    <div class="col-md-10 offset-md-2">
      <button type="button" class="btn btn-primary" :disabled="!newElementName || !newTaskName" @click="addNewElement">@lang('Company_Admin/dashboard.Save')</button>
      <button type="button" class="btn btn-secondary" @click="showNewElementForm = false">@lang('Company_Admin/dashboard.Cancel')</button>
    </div>
  </div>
</div>

    <!--div class="form-group row">
      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Element_type'):*</label>
      <div class="col-md-8">
        <v-select label="name" :options="element_type" v-model="job.element_type_id" placeholder="@lang('Company_Admin/dashboard.Select Element_type')" @input="elementChanged">
        </v-select>
    </div>
  </div-->

    <div class="form-group row">
      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Task'):*</label>
      <div class="col-md-8">
        <v-select :options="tasks" label="displayName" v-model="job.task_id" placeholder="@lang('Company_Admin/dashboard.Select Task')">
        </v-select>
    </div>
  </div>

  <!--div class="form-group row">
    <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Material'):*</label>
    <div class="col-md-8">
      <v-select :options="elements" label="name" v-model="job.element_id" placeholder="@lang('Company_Admin/dashboard.Select Element')">
      </v-select>
  </div>
</div-->

<!--div class="form-group row">
  <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Method'):*</label>
  <div class="col-md-8">
    <v-select :options="elements" label="name" v-model="job.element_id" placeholder="@lang('Company_Admin/dashboard.Select Element')">
    </v-select>
</div>
</div-->

  <div class="form-group row">
    <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Type'):*</label>
    <div class="col-md-8">
      <select class="form-control" v-model="job.type_name" name="" @change.prevent="typeChanged">
        <option :value="index" v-for="(type,index) in types">@{{type}}</option>
      </select>
    </div>
  </div>

  <div class="form-group col-md-offset-2" v-if="selectedType == 'daily'">
      @lang('Company_Admin/dashboard.Mon'): <input style="margin-right:10px;" type="checkbox" v-model="job.mon">
      @lang('Company_Admin/dashboard.Tue'): <input style="margin-right:10px;" type="checkbox" v-model="job.tue">
      @lang('Company_Admin/dashboard.Wed'): <input style="margin-right:10px;" type="checkbox" v-model="job.wed">
      @lang('Company_Admin/dashboard.Thur'): <input style="margin-right:10px;" type="checkbox" v-model="job.thu">
      @lang('Company_Admin/dashboard.Fri'): <input style="margin-right:10px;" type="checkbox" v-model="job.fri">
      @lang('Company_Admin/dashboard.Sat'): <input style="margin-right:10px;" type="checkbox" v-model="job.sat">
      @lang('Company_Admin/dashboard.Sun'): <input style="margin-right:10px;" type="checkbox" v-model="job.sun">
  </div>

  <div class="form-group col-md-offset-2" v-else-if="selectedType == 'extra' || selectedType == 'one-time'">

  <!-- add your extra/one-time form fields here -->

  </div>

  <div class="form-group col-md-offset-2" v-else>

    <div class="form-group row">
      <div class="col-md-9" style="margin-left: 5px; width: 80%;">
        <v-select :options="total_weeks" multiple v-model="selected_weeks" placeholder="@lang('Company_Admin/dashboard.Select week number')">
        </v-select>
      </div>
    </div>

  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-primary" @click.prevent="addTempJob">@lang('Company_Admin/dashboard.Add')</button>
  <button type="button" class="btn btn-secondary" @click.prevent ='modalClosed' data-dismiss="modal">@lang('Company_Admin/dashboard.Close')</button>
</div>
</div>
</div>
</div>
    </div>
  <!-- vue ends here -->
</div>
<!-- wrapper ending here -->

@endsection
@section('outer_script')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<script src="{{asset('js/vue.min.js')}}"></script>
<script src="{{asset('js/test/dist/vue-phone-number-input.umd.min.js')}}" charset="utf-8"></script>
<script type="text/javascript">

</script>
<script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('js/lodash.min.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script src="{{asset('js/vue-select-latest.js')}}"></script>

<script src="https://unpkg.com/vue-swal"></script>
{{--Key by it@cappah.com start--}}

<!--script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMpUuor6BOIooN2MgvKuWtRmcIXwYWrFg&libraries=places">
</script-->

<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC35SHRVQ0JebXbbRKgx85RTjZXDsDQH70&libraries=places">
</script>
{{--Key by it@cappah.com END--}}
{{--{{-al buraq logistics key-}}--}}
{{--<script--}}
{{--  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCR5PFyvraK8Cqbu-vQu7UAR-NkcABHNuw&libraries=places">--}}
{{--</script>--}}

{{--{{-Fahad Dev. Key-}}--}}
{{--<script--}}
{{--        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrK_NSUqXJCfquvxkwW-Al_EnltT7i7-c&callback=initMap&libraries=places&v=weekly"></script>--}}

<script src="{{asset('js/add_project.js')}}"></script>
@endsection

<!-- Content Header (Page header) -->

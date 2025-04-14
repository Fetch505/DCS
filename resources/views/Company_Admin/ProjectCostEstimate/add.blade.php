@extends('Company_Admin.layouts.main')

@section('outer_css')
  <style src="{{asset('public/select2/dist/css/select2.min.css')}}"></style>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


  <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
  <link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" type="text/css" />

  <style>

    /* input[type="checkbox"]{
      padding-left: 10px;
    } */

    input[type=checkbox] {
      transform: scale(1.5);
    }

    #checks {
      padding-left: 15px;
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

    [v-cloak] {display: none}
  </style>
  <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endsection


@section('title', 'Dashboard')
<div id="wrapper">
  @section('content')
    <div id="app" v-cloak>
      <input type="hidden" ref="language" value="{{App::getLocale()}}">
      <input type="hidden" ref='url' value="{{route('projectcostestimate.index')}}">
      <div class="row">
        <div class="col-sm-8">
          <h1>@lang('common.Project Calculation')</h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              @lang('common.Add new project calculation')
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <div class="">
                <form @submit.prevent="createProject">
                  <div class="form-group row">
                    <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Project') @lang('Company_Admin/dashboard.Name'):*</label>
                    <div class="col-md-8">
                      <input class="form-control" type="text" v-model:value="project_name">
                      <span style="color:red;" v-if="errors.project_name">@{{errors.project_name[0]}}</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-10 col-md-offset-2">
                      <div class="col-md-4">
                        <input type="radio" value="new" id="new1" v-model="client_type" @input="clientTypeChanged">
                        <label for="new1"> @lang('Company_Admin/dashboard.new_client')</label>
                      </div>

                      <div class="col-md-4">
                        <input type="radio" value="old" id="old1" v-model="client_type">
                        <label for="old1"> @lang('Company_Admin/dashboard.existing_client')</label>
                      </div>
                    </div>
                  </div>

                  <template v-if="client_type == 'new'">
                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.client_name'):*</label>
                      <div class="col-md-8">
                        <input class="form-control" type="text" v-model:value="client_name">
                        <span style="color:red;" v-if="errors.client_name">@{{errors.project_name[0]}}</span>
                      </div>
                    </div>
                  </template>

                  <template v-else>
                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.client_name'):*</label>
                      <div class="col-md-8">
                        <select class="form-control customers" v-model="client_name" @change.prevent="clientChanged">
                          <option value="">@lang('Company_Admin/dashboard.Select') @lang('Company_Admin/dashboard.Customer')</option>
                          <option v-for="customer in customers"  :value="customer">@{{ customer.name }}</option>
                        </select>
                      </div>
                    </div>
                  </template>

                  <div class="form-group row">
                    <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Email'):*</label>
                    <div class="col-md-8">
                      <input class="form-control" type="email" v-model:value="email">
                      <span style="color:red;" v-if="errors.email">@{{errors.email[0]}}</span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Phone'):*</label>
                    <div class="col-md-8">
                      <vue-phone-number-input default-country-code="NL" @update="onUpdate" v-model="phone"/>
                      <span style="color:red;" v-if="errors.phone">@{{errors.phone[0]}}</span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Address'):*</label>
                    <div class="col-md-8">
                      <input class="form-control" type="text" v-model:value="address">
                      <span style="color:red;" v-if="errors.address">@{{errors.address[0]}}</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-2" for="">@lang('Company_Admin/dashboard.contact_person1'):*</label>
                    <div class="col-md-8">
                      <input class="form-control" type="text" v-model:value="contact_person1">
                      <span style="color:red;" v-if="errors.contact_person1">@{{errors.contact_person1[0]}}</span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-2" for="">@lang('Company_Admin/dashboard.contact_person2'):*</label>
                    <div class="col-md-8">
                      <input class="form-control" type="text" v-model:value="contact_person2">
                      <span style="color:red;" v-if="errors.contact_person2">@{{errors.contact_person2[0]}}</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Start Date'):*</label>
                    <div class="col-md-8">
                      <input class="form-control" id="startDate" v-model:value="start_date" placeholder="dd/mm/yy">
                      <span style="color:red;" v-if="errors.start_date">@{{errors.start_date[0]}}</span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-2" for="">@lang('Company_Admin/dashboard.End Date'):*</label>
                    <div class="col-md-8">
                      <input class="form-control" id="endDate" v-model:value="end_date" placeholder="dd/mm/yy">
                      <span style="color:red;" v-if="errors.end_date">@{{errors.end_date[0]}}</span>
                    </div>
                  </div>


                  <div class="form-group row">
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        @lang('Company_Admin/dashboard.Area') @lang('Company_Admin/dashboard.Estimate')
                        <button type="button" class="btn btn-warning btn-sm pull-right" data-toggle="modal" data-target="#myModal" @click.prevent="clearModalBefore"><i class="fa fa-plus"></i></button>
                      </div>
                      <div class="panel-body">
                        <template v-if="basciNormTable.length > 0">
                          <div class="form-group row">
                            <div class="col-md-16 col-md-offset-1 table-responsive">
                              <table class="table table-bordered table-hovered table-striped">
                                <thead>
                                <th>@lang('Company_Admin/dashboard.Floor')</th>
                                <th>@lang('Company_Admin/dashboard.room_type')</th>
                                <th>@lang('Company_Admin/dashboard.Frequency')</th>
                                <th>@lang('Company_Admin/dashboard.Factor')</th>
                                <th>@lang('Company_Admin/dashboard.sq_meter_area_perHour')</th>
                                <th></th>
                                </thead>
                                <tbody>
                                <tr v-for="(data, index) in basciNormTable">
                                  <td>@{{data.floor_type.name}}</td>
                                  <td>@{{data.room_type.name}}</td>
                                  <td>@{{data.frequency}}</td>
                                  <td>@{{data.factor}}</td>
                                  <td>@{{data.sq_m_area_hour}}</td>
                                  <td>
                                    <button
                                            type="button"
                                            name="button"
                                            class="btn btn-danger btn-md" @click.prevent="deleteNormRow(index)"><i class="fa fa-trash"></i>
                                    </button>

                                    <button
                                            type="button"
                                            class="btn btn-success btn-md"
                                            data-toggle="modal"
                                            @click.prevent="calculateSpaceState(index)"
                                            data-target="#spaceStateModal"><i class="fa fa-compass"> @lang('Company_Admin/dashboard.Calculate')</i>
                                    </button>
                                  </td>
                                </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </template>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row" v-show="basciNormTable.length > 0">
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        @lang('Company_Admin/dashboard.Space_state') @lang('Company_Admin/dashboard.Calculation')
                        <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#spaceStateDetail"><i class="fa fa-calculator"> @lang('Company_Admin/dashboard.Detail')</i></button>
                      </div>
                      <div class="panel-body">
                        <div class="form-group row">
                          <div class="col-md-6">
                            <label for="floorType">@lang('Company_Admin/dashboard.Rate')</label>
                            <input class="form-control" type="text" name="" v-model:value="space_State_final.rate" readonly>
                          </div>
                          <div class="col-md-6">
                            <label for="floorType">@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.sq_meter_area_perHour')</label>
                            <input class="form-control" type="text" name="" v-model:value="space_State_final.total_sq_meter_area_perHour" readonly>
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="col-md-6">
                            <label for="floorType">@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Hours a Year')</label>
                            <input class="form-control" type="text" name="" v-model:value="space_State_final.total_hours_year" readonly>
                          </div>
                          <div class="col-md-6">
                            <label for="floorType">@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Hours a Day')</label>
                            <input class="form-control" type="text" name="" v-model:value="space_State_final.total_hours_day" readonly>
                          </div>
                        </div>

                        <div class="form-group row">
                          <!-- <div class="form-group input-group">
                            <input type="number" class="form-control" min="0" name="" v-model:value="sickdays_comp" readonly>
                            <span class="input-group-addon">%</span>
                          </div> -->
                          <div class="col-md-6 ">
                            <label for="floorType">@lang('Company_Admin/dashboard.Contract Sum a Year') </label>
                            <div class="form-group input-group">
                              <span class="input-group-addon"><i class="fa fa-euro"></i></span><input class="form-control" type="text" name="" v-model:value="space_State_final.contract_sum_year" readonly>
                            </div>
                          </div>
                          <div class="col-md-6">

                          </div>
                        </div>

                        <template v-if="space_State_Table.length > 0">
                          <div class="form-group row">
                            <div class="col-md-16 col-md-offset-1  table-responsive">
                              <table class="table table-bordered table-hovered table-striped">
                                <thead>
                                <th>@lang('Company_Admin/dashboard.sq_meter')</th>
                                <th>@lang('Company_Admin/dashboard.Norm')</th>
                                <th>@lang('Company_Admin/dashboard.Hours per Turn')</th>
                                <th>@lang('Company_Admin/dashboard.Frequency')</th>
                                <th>@lang('Company_Admin/dashboard.Hours a Year')</th>
                                <th>@lang('Company_Admin/dashboard.Rate')</th>
                                <th>@lang('Company_Admin/dashboard.Amount')</th>
                                <th></th>
                                </thead>
                                <tbody>
                                <tr v-for="(data, index) in space_State_Table">
                                  <td>@{{data.sq_meter}}</td>
                                  <td>@{{data.norm}}</td>
                                  <td>@{{data.hours_per_turn}}</td>
                                  <td>@{{data.frequency}}</td>
                                  <td>@{{data.hours_a_year}}</td>
                                  <td>@{{data.rate}}</td>
                                  <td><i class="fa fa-euro"></i> @{{data.amount}}</td>
                                  <td>
                                    <button
                                            type="button"
                                            name="button"
                                            class="btn btn-danger btn-md" @click.prevent="deleteSpaceStateRow(index)"><i class="fa fa-trash"></i>
                                    </button>
                                  </td>
                                </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </template>
                      </div>
                    </div>
                  </div>

                  <div class="inline pull-right">
                    <button type="submit" class="btn btn-success" >@lang('Company_Admin/dashboard.Create')</button>
                    <a href="{{ route('projectcostestimate.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- space state details Modals starts here -->

      <div class="modal fade" id="spaceStateDetail" role="dialog">
        <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">@lang('Company_Admin/dashboard.Calculation') @lang('Company_Admin/dashboard.Detail')</h4>
            </div>
            <div class="modal-body">
              <div class="panel panel-success">
                <div class="panel-heading">@lang('Company_Admin/dashboard.PRODUCTION-HOURS MONDAY-FRIDAY') - 06.00:21.30</div>
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                      <thead>
                      <th>@lang('Company_Admin/dashboard.employee_group')</th>
                      <th>@lang('Company_Admin/dashboard.Percentage')</th>
                      <th>@lang('Company_Admin/dashboard.Hours a Year')</th>
                      <th>@lang('Company_Admin/dashboard.Rate')</th>
                      <th>@lang('Company_Admin/dashboard.Price a Year')</th>
                      <th>@lang('Company_Admin/dashboard.Gross Hourly Wage')</th>
                      <th>@lang('Company_Admin/dashboard.Costs a Year')</th>
                      <th>% @lang('Company_Admin/dashboard.Reward')</th>
                      <th>@lang('Company_Admin/dashboard.hourly_rate_structure')</th>
                      </thead>
                      <tbody>
                      <tr v-for="(entry,id) in prd_hr_mon_fri_Table">
                        <td>@{{entry.group_name}}</td>
                        <td>@{{entry.percentage}}%</td>
                        <td>@{{entry.number_of_hours_year}}</td>
                        <td>@{{entry.hourly_rate}}</td>
                        <td>@{{entry.price_a_year}}</td>
                        <td>@{{entry.gross_wage}}</td>
                        <td>@{{entry.cost_a_year}}</td>
                        <td>@{{entry.reward}}%</td>
                      </tr>
                      </tbody>
                      <tfoot>
                      <tr>
                        <td></td>
                        <th>@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Hours a Year')</th>
                        <td>@{{prd_hr_mon_fri_total_hour}} </td>
                        <th>@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Production') @lang('Company_Admin/dashboard.Price a Year')</th>
                        <td>@{{prd_hr_mon_fri_Total_price}}</td>
                        <th>@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Production') @lang('Company_Admin/dashboard.Cost a Year')</th>
                        <td>@{{prd_hr_mon_fri_Total_cost}}</td>
                        <th>@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Production') @lang('Company_Admin/dashboard.Cost a Year') / @lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Hours a Year')</th>
                        <td><i class="fa fa-euro"></i> @{{prd_hr_mon_fri_Total_hourly_structure}}</td>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
              <div class="panel panel-info">
                <div class="panel-heading">@lang('Company_Admin/dashboard.DIRECT SUPERVISION-HOURS MONDAY-FRIDAY') - 06.00: 21.30</div>
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                      <thead>
                      <th>@lang('Company_Admin/dashboard.employee_group')</th>
                      <th>@lang('Company_Admin/dashboard.Percentage')</th>
                      <th>@lang('Company_Admin/dashboard.Hours a Year')</th>
                      <th>@lang('Company_Admin/dashboard.Rate')</th>
                      <th>@lang('Company_Admin/dashboard.Price a Year')</th>
                      <th>@lang('Company_Admin/dashboard.Gross Hourly Wage')</th>
                      <th>@lang('Company_Admin/dashboard.Cost a Year')</th>
                      <th>% @lang('Company_Admin/dashboard.Reward')</th>
                      <th>@lang('Company_Admin/dashboard.hourly_rate_structure')</th>
                      </thead>
                      <tbody>
                      <tr v-for="(entry,id) in drt_sup_hr_mon_fri_Table">
                        <td>@{{entry.group_name}}</td>
                        <td>@{{entry.percentage}}%</td>
                        <td>@{{entry.number_of_hours_year}}</td>
                        <td>@{{entry.hourly_rate}}</td>
                        <td>@{{entry.price_a_year}}</td>
                        <td>@{{entry.gross_wage}}</td>
                        <td>@{{entry.cost_a_year}}</td>
                        <td>@{{entry.reward}}%</td>
                      </tr>
                      <tr>
                        <td></td>
                        <th>@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Direct Supervision') @lang('Company_Admin/dashboard.Hours a Year')</th>
                        <td>@{{drt_sup_hr_mon_fri_total_hour}} </td>
                        <th>@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Direct Supervision') @lang('Company_Admin/dashboard.Price a Year')</th>
                        <td>@{{drt_sup_hr_mon_fri_Total_price}}</td>
                        <th>@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Direct Supervision') @lang('Company_Admin/dashboard.Cost a Year')</th>
                        <td>@{{drt_sup_hr_mon_fri_Total_cost}}</td>
                        <th>@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Direct Supervision') @lang('Company_Admin/dashboard.Cost a Year') / @lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Hours a Year')</th>
                        <td><i class="fa fa-euro"></i> @{{drt_sup_hr_mon_fri_Total_hourly_structure}}</td>
                      </tr>
                      </tbody>
                      <tfoot>
                      <tr>
                        <td></td>
                        <th></th>
                        <td></td>
                        <th>
                          @lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Price a Year') = @lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Price a Year') + @lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Direct Supervision') @lang('Company_Admin/dashboard.Price a Year')
                        </th>
                        <td>
                          @{{prd_hr_mon_fri_Total_price}} +
                          @{{drt_sup_hr_mon_fri_Total_price}} =
                          @{{space_State_final.contract_sum_year}}
                        </td>
                        <th>
                          @lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Cost a Year') = @lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Production') @lang('Company_Admin/dashboard.Cost a Year') + @lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Direct Supervision') @lang('Company_Admin/dashboard.Cost a Year')
                        </th>
                        <td>
                          @{{prd_hr_mon_fri_Total_cost}} + @{{drt_sup_hr_mon_fri_Total_cost}} =
                          @{{space_State_final.total_cost_year}}
                        </td>
                        <th>
                          @lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.hourly_rate_structure')
                        </th>
                        <td>
                          @{{prd_hr_mon_fri_Total_hourly_structure}} +
                          @{{drt_sup_hr_mon_fri_Total_hourly_structure}} =
                          <i class="fa fa-euro"></i> @{{space_State_final.total_rate_structure}}</td>
                      </tr>
                      <tr></tr>
                      <tr>
                        <td></td>
                        <th>
                          @lang('Company_Admin/dashboard.AVERAGE HOUR RATE INCLUSIF DIRECTE MANAGEMENT on basis of calculation')
                        </th>
                        <td></td>
                        <th>
                          @lang('Company_Admin/dashboard.Price a Year') @lang('Company_Admin/dashboard.Rate') = @lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Price a Year') / @lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Hours a Year')
                        </th>
                        <td>
                          @{{space_State_final.contract_sum_year}} / @{{space_State.total_hours_year}} = @{{space_State_final.rate}}
                        </td>
                        <th>
                          @lang('Company_Admin/dashboard.Cost a Year') @lang('Company_Admin/dashboard.Rate') = @lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Cost a Year') / @lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Hours a Year')
                        </th>
                        <td>
                          @{{space_State_final.total_cost_year}} / @{{space_State.total_hours_year}} = @{{space_State_final.cost_rate}}
                        </td>
                        <th></th>
                        <td></td>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <div class="well">
                    <h4>@lang('Company_Admin/dashboard.Calculation') @lang('Company_Admin/dashboard.Information') :</h4>
                    <p>@lang('Company_Admin/dashboard.Average') @lang('Company_Admin/dashboard.Hour') @lang('Company_Admin/dashboard.Rate')(@lang('Company_Admin/dashboard.Included Management')) = @{{space_State_final.rate}}</p>
                    <p>@lang('Company_Admin/dashboard.Average') @lang('Company_Admin/dashboard.Hour') @lang('Company_Admin/dashboard.Rate') @lang('Company_Admin/dashboard.Production') = @{{prd_hr_mon_fri_rate}}</p>
                    <p>@lang('Company_Admin/dashboard.Average') @lang('Company_Admin/dashboard.Rate') (@lang('Company_Admin/dashboard.Supervisor'))= @{{drt_sup_hr_mon_fri_rate}}</p>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="well">
                    <h4>@lang('Company_Admin/dashboard.Cost a Year') @lang('Company_Admin/dashboard.Rate')</h4>
                    <p>@lang('Company_Admin/dashboard.Rate') = @lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Cost a Year') / @lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Hours a Year')</p>
                    <p>@lang('Company_Admin/dashboard.Rate') = @{{space_State_final.total_cost_year}} / @{{space_State.total_hours_year}}</p>
                    <p>@lang('Company_Admin/dashboard.Rate') = @{{space_State_final.cost_rate}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Company_Admin/dashboard.Close')</button>
            </div>
          </div>

        </div>
      </div>

      <!-- space state details Modals ends here -->

      <!-- Modal for area estimate and basic norm starts here -->

      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" @click.prevent="closeModal" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">@lang('Company_Admin/dashboard.Basic Norn Calculation')</h4>
            </div>
            <div class="modal-body">

              <form role="form">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="floorType">@lang('Company_Admin/dashboard.Floor') @lang('Company_Admin/dashboard.Type')</label>
                    <v-select :options="floor_types" label="name" v-model="basic_norm.floor_type" placeholder="@lang('Company_Admin/dashboard.Select') @lang('Company_Admin/dashboard.Floor') @lang('Company_Admin/dashboard.Type')" @input="floorTypeChanged">
                    </v-select>
                  </div>

                  <div class="col-md-6">
                    <label for="floorType">@lang('Company_Admin/dashboard.room_type')</label>
                    <v-select :options="room_types" label="name" v-model="basic_norm.room_type" placeholder="@lang('Company_Admin/dashboard.Select') @lang('Company_Admin/dashboard.Room') @lang('Company_Admin/dashboard.Type')" @input="roomTypeChanged">
                    </v-select>
                  </div>
                </div>

                <div class="form-group row" v-show="comments.length > 1">
                  <div class="col-md-6">
                    <label for="floorType">@lang('Company_Admin/dashboard.comment')</label>
                    <v-select :options="comments" label="comments" v-model="basic_norm.comment" placeholder="@lang('Company_Admin/dashboard.Select') @lang('Company_Admin/dashboard.Comment')">
                    </v-select>
                  </div>
                </div>

                <div class="panel panel-primary">
                  <div class="panel-heading">
                    @lang('Company_Admin/dashboard.Add Tasks')
                  </div>
                  <div class="panel-body">
                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Task')</label>
                      <div class="col-md-8">
                        <v-select :options="tasks" label="name" v-model="task_entry.task" placeholder="@lang('Company_Admin/dashboard.Select') @lang('Company_Admin/dashboard.Task')">
                        </v-select>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-md-16 col-md-offset-2">
                  <span id="checks">
                    @lang('Company_Admin/dashboard.Mon'): <input
                            type="checkbox"
                            @change.prevent="task_freq"
                            v-model:checked="task_check_status_mon">
                  </span>

                        <span id="checks">
                    @lang('Company_Admin/dashboard.Tue'): <input
                                  type="checkbox"
                                  v-model:checked="task_check_status_tue" @change.prevent="task_freq">
                  </span>

                        <span id="checks">
                    @lang('Company_Admin/dashboard.Wed'): <input
                                  type="checkbox"
                                  v-model:checked="task_check_status_wed" @change.prevent="task_freq">
                  </span>

                        <span id="checks">
                    @lang('Company_Admin/dashboard.Thur'): <input
                                  type="checkbox"
                                  v-model:checked="task_check_status_thu" @change.prevent="task_freq">
                  </span>

                        <span id="checks">
                    @lang('Company_Admin/dashboard.Fri'): <input
                                  type="checkbox"
                                  v-model:checked="task_check_status_fri" @change.prevent="task_freq">
                  </span>

                        <span id="checks">
                    @lang('Company_Admin/dashboard.Sat'): <input
                                  type="checkbox"
                                  v-model:checked="task_check_status_sat" @change.prevent="task_freq">
                  </span>

                        <span id="checks">
                    @lang('Company_Admin/dashboard.Sun'): <input
                                  type="checkbox"
                                  v-model:checked="task_check_status_sun" @change.prevent="task_freq">
                  </span>
                      </div>

                    </div>

                    <div class="form-group col-md-4 col-md-offset-2" v-show="task_days_count === 5">
                      <input type="radio" name="shift" value="1" v-model="shiftType"> @lang('Company_Admin/dashboard.Single') @lang('Company_Admin/dashboard.shift a day') <br>
                      <input type="radio" name="shift" value="2" v-model="shiftType"> @lang('Company_Admin/dashboard.Double') @lang('Company_Admin/dashboard.shift a day')<br>
                    </div>

                    <div class="form-group">
                      <a
                              class="btn btn-success btn-md pull-right"
                              href="#"
                              @click.prevent="addTask"
                      >+</a>
                    </div>
                  </div>

                  <div class="panel-footer  table-responsive">
                    <table class="table table-striped">
                      <thead>
                      <th>@lang('Company_Admin/dashboard.Task')</th>
                      <th>@lang('Company_Admin/dashboard.Frequency')</th>
                      <th></th>
                      </thead>
                      <tbody>
                      <tr v-for="(task,id) in basic_norm.tasks_table">
                        <td>@{{task.task_name}}</td>
                        <td>@{{task.task_frequency}}</td>
                        <td> <button
                                  type="button"
                                  name="button"
                                  class="btn btn-danger btn-md" @click.prevent="deleteTask(task.task_object,id)"><i class="fa fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                    <br>
                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Frequency')</label>
                      <div class="col-md-8">
                        <input class="form-control" type="number" min="0" name="" v-model:value="basic_norm.maxFrequency" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="panel panel-primary">
                  <div class="panel-heading">
                    @lang('Company_Admin/dashboard.Add Elements')
                  </div>
                  <div class="panel-body">
                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Element')</label>
                      <div class="col-md-8">
                        <v-select :options="elements" label="name" v-model="element_entry.element" placeholder="@lang('Company_Admin/dashboard.Select') @lang('Company_Admin/dashboard.Element')">
                        </v-select>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-md-16 col-md-offset-2">
                  <span id="checks">
                    @lang('Company_Admin/dashboard.Mon'): <input
                            type="checkbox"
                            @change.prevent="element_freq"
                            v-model:checked="element_check_status_mon">
                  </span>

                        <span id="checks">
                    @lang('Company_Admin/dashboard.Tue'): <input
                                  type="checkbox"
                                  v-model:checked="element_check_status_tue" @change.prevent="element_freq">
                  </span>

                        <span id="checks">
                    @lang('Company_Admin/dashboard.Wed'): <input
                                  type="checkbox"
                                  v-model:checked="element_check_status_wed" @change.prevent="element_freq">
                  </span>

                        <span id="checks">
                    @lang('Company_Admin/dashboard.Thur'): <input
                                  type="checkbox"
                                  v-model:checked="element_check_status_thu" @change.prevent="element_freq">
                  </span>

                        <span id="checks">
                    @lang('Company_Admin/dashboard.Fri'): <input
                                  type="checkbox"
                                  v-model:checked="element_check_status_fri" @change.prevent="element_freq">
                  </span>

                        <span id="checks">
                    @lang('Company_Admin/dashboard.Sat'): <input
                                  type="checkbox"
                                  v-model:checked="element_check_status_sat" @change.prevent="element_freq">
                  </span>

                        <span id="checks">
                    @lang('Company_Admin/dashboard.Sun'): <input
                                  type="checkbox"
                                  v-model:checked="element_check_status_sun" @change.prevent="element_freq">
                  </span>
                      </div>
                    </div>

                    <div class="form-group">
                      <a
                              class="btn btn-success btn-md pull-right"
                              href="#"
                              @click.prevent="addElement"
                      >+</a>
                    </div>
                  </div>

                  <div class="panel-footer table-responsive">
                    <table class="table table-striped">
                      <thead>
                      <th>@lang('Company_Admin/dashboard.Task')</th>
                      <th>@lang('Company_Admin/dashboard.Frequency')</th>
                      <th></th>
                      </thead>
                      <tbody>
                      <tr v-for="(element,id) in basic_norm.elements_table">
                        <td>@{{element.element_name}}</td>
                        <td>@{{element.element_frequency}}</td>
                        <td> <button
                                  type="button"
                                  name="button"
                                  class="btn btn-danger btn-md" @click.prevent="deleteElement(element.element_object,id)"><i class="fa fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2" for="factor">@lang('Company_Admin/dashboard.Factor')</label>
                  <div class="col-md-8">
                    <input class="form-control" type="number" min="0" max="2" name="factor" v-model:value="basic_norm.factor">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2" for="">@lang('Company_Admin/dashboard.sq_meter_area_perHour')</label>
                  <div class="col-md-8">
                    <input class="form-control" type="number" readonly v-model:value="calculateNormComp">
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer inline">
              <span style="color:red;">@{{addNormError}}</span>
              <button type="button" :disabled="addButton"
                      class="btn btn-success"
                      data-dismiss="modal"
                      @click.prevent="addNorm">
                @lang('Company_Admin/dashboard.Add')
              </button>

              <button type="button"
                      class="btn btn-danger"
                      data-dismiss="modal"
                      @click.prevent="closeModal">
                @lang('Company_Admin/dashboard.Close')
              </button>
            </div>
          </div>

        </div>
      </div>

      <!-- Modal for calculate space starte starts here -->

      <div id="spaceStateModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" @click.prevent="closeModal" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">@lang('Company_Admin/dashboard.Space_state')</h4>
            </div>
            <div class="modal-body">

              <form role="form">

                <div class="form-group row">
                  <label class="col-md-2" for="factor">@lang('Company_Admin/dashboard.sq_meter') @lang('Company_Admin/dashboard.Area')</label>
                  <div class="col-md-8">
                    <input class="form-control" min="0" type="number" @input="debounceMeterArea" v-model:value="space_State.meter_Square_area">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="floorType">@lang('Company_Admin/dashboard.Norm') (@lang('Company_Admin/dashboard.sq_meter_area_perHour'))</label>
                    <input class="form-control" type="text" name="" v-model:value="space_State.norm" readonly>
                  </div>
                  <div class="col-md-6">
                    <label for="floorType">@lang('Company_Admin/dashboard.Frequency')</label>
                    <input class="form-control" type="text" name="" v-model:value="space_State.frequency" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="floorType">@lang('Company_Admin/dashboard.Rate')</label>
                    <input class="form-control" type="text" name="" v-model:value="space_State.rate" readonly>
                  </div>
                  <div class="col-md-6">
                    <label for="floorType">@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.sq_meter_area_perHour')</label>
                    <input class="form-control" type="text" name="" v-model:value="total_sq_meter_area_comp" readonly>
                  </div>
                </div>

                <div class="panel panel-primary">
                  <div class="panel-heading">
                    @lang('Company_Admin/dashboard.PRODUCTION-HOURS MONDAY-FRIDAY') 06:00-21:30
                  </div>
                  <div class="panel-body">

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-4" for="">@lang('Company_Admin/dashboard.Worker Group')</label>
                        <div class="col-md-12">
                          <v-select :options="workerGroups" label="name" v-model="worker_group.group" placeholder="@lang('Company_Admin/dashboard.Select') @lang('Company_Admin/dashboard.Worker Group')" @input="groupChange">
                          </v-select>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <label class="col-md-8" for="">
                          @lang('Company_Admin/dashboard.hourly_rate'):
                        </label>
                        <div class="col-md-12">
                          <div class="form-group">
                            <input type="number" readonly min="0" class="form-control"
                                   v-model="worker_group.hourly_rate">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <label class="col-md-5" for="">
                          @lang('Company_Admin/dashboard.Percentage'):*
                        </label>
                        <div class="col-md-12">
                          <div class="form-group input-group">
                            <input type="number" min="0" max="100" class="form-control"
                                   v-model="worker_group.percentage">
                            <span class="input-group-addon">%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <a
                              class="btn btn-success btn-md pull-right"
                              href="#"
                              @click.prevent="addGroup"
                      >+</a>
                    </div>
                  </div>
                  <div class="panel-footer table-responsive">
                    <table class="table table-striped">
                      <thead>
                      <th>@lang('Company_Admin/dashboard.Worker Group')</th>
                      <th>@lang('Company_Admin/dashboard.hourly_rate')</th>
                      <th>@lang('Company_Admin/dashboard.Percentage')</th>
                      <th></th>
                      </thead>
                      <tbody>
                      <tr v-for="(entry,id) in prd_hr_mon_fri_Table">
                        <td>@{{entry.group_name}}</td>
                        <td>@{{entry.hourly_rate}}</td>
                        <td>@{{entry.percentage}}%</td>
                        <td>
                          <template v-if="id">
                            <button
                                    type="button"
                                    name="button"
                                    class="btn btn-danger btn-md" @click.prevent="delprdhrGroup(entry.group_detail,id,entry.percentage)"><i class="fa fa-trash"></i>
                            </button>
                          </template>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="panel panel-primary">
                  <div class="panel-heading">
                    @lang('Company_Admin/dashboard.DIRECT SUPERVISION-HOURS MONDAY-FRIDAY') 06:00-21:30
                  </div>
                  <div class="panel-body">


                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-4" for="">@lang('Company_Admin/dashboard.Worker Group')</label>
                        <div class="col-md-12">
                          <v-select :options="workerGroups" label="name" v-model="drt_sup_worker_group.group" placeholder="@lang('Company_Admin/dashboard.Select') @lang('Company_Admin/dashboard.Worker Group')" @input="groupDirectChange">
                          </v-select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label class="col-md-8" for="">
                          @lang('Company_Admin/dashboard.hourly_rate'):
                        </label>
                        <div class="col-md-12">
                          <div class="form-group">
                            <input type="number" readonly min="0" class="form-control"
                                   v-model="drt_sup_worker_group.hourly_rate">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <label class="col-md-5" for="">
                          @lang('Company_Admin/dashboard.Percentage'):*
                        </label>
                        <div class="col-md-12">
                          <div class="form-group input-group">
                            <input type="number" min="0" max="100" class="form-control"
                                   v-model="drt_sup_worker_group.percentage">
                            <span class="input-group-addon">%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <a
                              class="btn btn-success btn-md pull-right"
                              href="#"
                              @click.prevent="addDirectGroup"
                      >+</a>
                    </div>
                  </div>

                  <div class="panel-footer table-responsive">
                    <table class="table table-striped">
                      <thead>
                      <th>@lang('Company_Admin/dashboard.Worker Group')</th>
                      <th>@lang('Company_Admin/dashboard.hourly_rate')</th>
                      <th>@lang('Company_Admin/dashboard.Percentage')</th>
                      <th></th>
                      </thead>
                      <tbody>
                      <tr v-for="(entry,id) in drt_sup_hr_mon_fri_Table">
                        <td>@{{entry.group_name}}</td>
                        <td>@{{entry.hourly_rate}}</td>
                        <td>@{{entry.percentage}}%</td>
                        <td>
                          <button
                                  type="button"
                                  name="button"
                                  class="btn btn-danger btn-md" @click.prevent="deldrthrGroup(entry.group_detail,id)"><i class="fa fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="floorType">@lang('Company_Admin/dashboard.Rate')</label>
                    <input class="form-control" type="text" name="" v-model:value="rate_comp" readonly>
                  </div>
                  <div class="col-md-6">
                    <label for="floorType">@lang('Company_Admin/dashboard.Amount')</label>
                    <div class="form-group input-group">
                      <span class="input-group-addon"><i class="fa fa-euro"></i></span><input class="form-control" type="text" name="" v-model:value="space_State.amount" readonly>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer inline">
              <span style="color:red;">@{{addSpaceStError}}</span>
              <button type="button"
                      class="btn btn-success"
                      data-dismiss="modal"
                      :disabled="calculateButton"
                      @click.prevent="calculateAmount">
                @lang('Company_Admin/dashboard.Calculate')
              </button>

              <button type="button"
                      class="btn btn-danger"
                      data-dismiss="modal"
                      @click.prevent="closeSpaceStateModal">
                @lang('Company_Admin/dashboard.Close')
              </button>
            </div>
          </div>

        </div>
      </div>

      <!-- Modal for calculate space starte ends here -->
      <!-- vue ends here -->
    </div>
    <!-- wrapper ending here -->

  @endsection
  @section('outer_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

    <script src="{{asset('public/js/lodash.min.js')}}"></script>
    <script src="{{asset('public/js/axios.min.js')}}"></script>
    <script src="{{asset('public/js/vue.min.js')}}"></script>
    <script src="https://unpkg.com/vue-swal"></script>
    <script src="{{asset('public/js/vue-select-latest.js')}}"></script>

    <script src="{{asset('public/js/test/dist/vue-phone-number-input.umd.min.js')}}" charset="utf-8"></script>
    <!-- <script src="https://unpkg.com/vue-select@latest"></script> -->
  <!-- <script src="{{asset('js/vue-select.js')}}"></script> -->
    <script src="{{asset('public/js/ProjectCostEstimate/app.js')}}"></script>


@endsection

<!-- Content Header (Page header) -->

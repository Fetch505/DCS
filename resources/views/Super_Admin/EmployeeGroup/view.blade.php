@extends('Super_Admin.layouts.admin')

@section('outer_css')
  <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('title', 'Dashboard')

@section('content')
  <section class="content">
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Employee Group Management')</h1>
      </div>
    </div>

    <div class="row" id="app">
      <input type="hidden" ref="id" value="{{$id}}">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  @lang('common.Employee Group details')
                  <div class="pull-right">
                    <a href="{{ route('employeeGroup.index') }}" type="button" class="btn btn-primary">@lang('Company_Admin/dashboard.Back')</a>
                  </div>
                </div>
                <div class="panel-body">
                  <div class="">
                    <div class="form-group row">
                      <div class="col-md-12">
                        <label class="col-md-2" for="">
                          Group Name:*
                        </label>
                          <div class="col-md-9">
                            <input type="text" class="form-control" v-model:value="employeeGroup.group_name" readonly>
                          </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Basic Hour Rate:*</label>
                          <div class="col-md-4">
                            <input type="number" class="form-control" min="0" name="" v-model:value="employeeGroup.basic_hour_rate" readonly>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Gross hour wage:*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" readonly min="0" class="form-control" v-model:value="employeeGroup.gross_hour_wage">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          End year allowence (%):*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" min="0" class="form-control" v-model:value="employeeGroup.end_year_allowence_percent" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          End year allowence value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" readonly class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.end_year_allowence_value">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Holliday allowence (%):*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" min="0" class="form-control" v-model:value="employeeGroup.holiday_allowence_percent" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Holliday allowence value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" readonly class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.holiday_allowence_value">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Gross wage including allowaence:*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" readonly min="0" class="form-control" v-model:value="employeeGroup.gross_wage_including_allowaence">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Social insurance premiums (%):*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.social_insurance_premiums_percent" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Social insurance premiums value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.social_insurance_premiums_value" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Nationale holidays (%):*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.nationale_holidays_percent" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Nationale holidays value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.nationale_holidays_value" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Holidays (%):*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.holidays_percent" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Holidays value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.holidays_value" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Costs absenteeism (%):*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.costs_absenteeism_percent" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Costs absenteeism value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.costs_absenteeism_value" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Subtotal wage costs per hour:*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" readonly min="0" class="form-control" v-model:value="employeeGroup.subtotal_wage_costs_per_hour">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Total wage costs per hour:*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" readonly min="0" class="form-control" v-model:value="employeeGroup.total_wage_costs_per_hour">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Material/- en recorses, machines (%):*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.material_en_recorses_machines_percent" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Material/- en recorses, machines Value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.material_en_recorses_machines_value" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Workclothing en equipment (%):*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.workclothing_en_equipment_percent" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Workclothing en equipment Value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.workclothing_en_equipment_value" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Total Direct Cost:*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" readonly min="0" class="form-control" v-model:value="employeeGroup.total_direct_costs">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Indirectly supervision & Managementcosts (%):*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.indirectly_supervision_managementcosts_percent" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Indirectly supervision & Managementcosts Value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.indirectly_supervision_managementcosts_value" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Education & training (%):*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.education_training_percent" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Education & training Value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.education_training_value" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Companycosts, Administration- & housing costs (%):*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.companycosts_administration_housing_costs_percent" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Companycosts, Administration- & housing costs Value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.companycosts_administration_housing_costs_value" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>


                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Reis-Auto Kosten / overige (%):*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.reis_auto_kosten_overige_percent" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Reis-Auto Kosten / overige Value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.reis_auto_kosten_overige_value" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Total Indirect Cost:*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" readonly min="0" class="form-control" v-model:value="employeeGroup.total_indirecte_costs">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Risk and profit (%):*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.risk_and_profit_percent" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Risk and profit Value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.risk_and_profit_value" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Total end wage normale workhours (06.00-21.30):*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" readonly min="0" class="form-control" v-model:value="employeeGroup.total_end_wage_normale_workhours_06_to_21">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Total endwage weekend (incl. 50% toeslag):*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" readonly min="0" class="form-control" v-model:value="employeeGroup.total_endwage_weekend_incl_50_toeslag">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Total endwage holidays (incl. 150% toeslag):*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" readonly min="0" class="form-control" v-model:value="employeeGroup.total_endwage_holidays_incl_150_toeslag">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Marge loonkosten - eindtarief:*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" readonly min="0" class="form-control" v-model:value="employeeGroup.marge_loonkosten_eindtarief">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!-- vue ends here -->
    </section>
  @endsection

  @section('outer_script')
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script> -->

    <script src="{{asset('js/lodash.min.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/vue.min.js')}}"></script>
    <script src="https://unpkg.com/vue-swal"></script>
    <script src="{{asset('js/vue-select-latest.js')}}"></script>
    <script src="{{asset('js/HourlyRate/employee_group_view.js')}}"></script>
  @endsection

<!-- Content Header (Page header) -->

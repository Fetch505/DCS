@extends('Super_Admin.layouts.admin')

@section('outer_css')
  <link href="{{asset('public/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
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
        <input type="hidden" ref='url' value="{{route('employeeGroup.index')}}">
        <input type="hidden" ref="language" value="{{App::getLocale()}}">
        <input type="hidden" ref="id" value="{{$id}}">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  @lang('common.Edit employees group')
                </div>
                <div class="panel-body">
                  <div class="">

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Group Name:*
                        </label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" v-model:value="employeeGroup.group_name">
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Basic Hour Rate:*</label>
                          <div class="col-md-4">
                            <input type="number" class="form-control" min="0" name="" v-model:value="employeeGroup.basic_hour_rate">
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Gross hour wage:*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" readonly min="0" class="form-control" v-model:value="gross_hour_wage_comp">
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
                                <input type="number" min="0" class="form-control" v-model:value="employeeGroup.end_year_allowence_percent">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          End year allowence value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" readonly class="form-control" min="0" max="100" name="" v-model:value="end_year_allowence_comp">
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
                                <input type="number" min="0" class="form-control" v-model:value="employeeGroup.holiday_allowence_percent">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Holliday allowence value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" readonly class="form-control" min="0" max="100" name="" v-model:value="holiday_allowence_comp">
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
                                <input type="number" readonly min="0" class="form-control" v-model:value="gross_wage_including_allowaence_comp">
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
                                <input type="number" class="form-control" min="0" name="" v-model:value="employeeGroup.social_insurance_premiums_percent" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Social insurance premiums value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="social_insurance_premiums_comp" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Subtotaal wage costs per hour 1:*
                        </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" readonly min="0" class="form-control" v-model:value="employeeGroup.subtotal_wage_costs_per_hour_1">
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
                                <input type="number" class="form-control" min="0" name="" v-model:value="employeeGroup.nationale_holidays_percent" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Nationale holidays value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="nationale_holidays_comp" readonly>
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
                                <input type="number" class="form-control" min="0" name="" v-model:value="employeeGroup.holidays_percent" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Holidays value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="holidays_comp" readonly>
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
                                <input type="number" class="form-control" min="0" name="" v-model:value="employeeGroup.costs_absenteeism_percent" readonly>
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Costs absenteeism value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="costs_absenteeism_comp" readonly>
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
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.material_en_recorses_machines_percent">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Material/- en recorses, machines Value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="material_en_recorses_machines_comp" readonly>
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
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.workclothing_en_equipment_percent">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Workclothing en equipment Value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="workclothing_en_equipment_comp" readonly>
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
                                <input type="number" readonly min="0" class="form-control" v-model:value="total_direct_costs_comp">
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
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.indirectly_supervision_managementcosts_percent">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Indirectly supervision & Managementcosts Value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="indirectly_supervision_managementcosts_comp" readonly>
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
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.education_training_percent">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Education & training Value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="education_training_comp" readonly>
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
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.companycosts_administration_housing_costs_percent">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Companycosts, Administration- & housing costs Value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="companycosts_administration_housing_costs_comp" readonly>
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
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.reis_auto_kosten_overige_percent">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Reis-Auto Kosten / overige Value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="reis_auto_kosten_overige_comp" readonly>
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
                                <input type="number" readonly min="0" class="form-control" v-model:value="total_indirecte_costs_comp">
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
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="employeeGroup.risk_and_profit_percent">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Risk and profit Value:*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="risk_and_profit_comp" readonly>
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
                                <input type="number" readonly min="0" class="form-control" v-model:value="total_end_wage_normale_workhours_06_to_21_comp">
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
                                <input type="number" readonly min="0" class="form-control" v-model:value="total_endwage_weekend_incl_50_toeslag_comp">
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
                                <input type="number" readonly min="0" class="form-control" v-model:value="total_endwage_holidays_incl_150_toeslag_comp">
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
                                <input type="number" readonly min="0" class="form-control" v-model:value="marge_loonkosten_eindtarief_comp">
                                <span class="input-group-addon">%</span>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="inline pull-right">
                      <button
                        type="button"
                        class="btn btn-success"
                        @click.prevent="saveValues">
                        @lang('Company_Admin/dashboard.Save')
                      </button>

                      <a href="{{ route('employeeGroup.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
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

    <script src="{{asset('public/js/vue.min.js')}}"></script>
    <script src="{{asset('public/js/lodash.min.js')}}"></script>
    <script src="{{asset('public/js/axios.min.js')}}"></script>
    <script src="https://unpkg.com/vue-swal"></script>
    <script src="{{asset('public/js/vue-select-latest.js')}}"></script>
    <script src="{{asset('public/js/HourlyRate/employee_group_edit.js')}}"></script>
  @endsection

<!-- Content Header (Page header) -->

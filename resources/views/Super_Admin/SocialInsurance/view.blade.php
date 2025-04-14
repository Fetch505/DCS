@extends('Super_Admin.layouts.admin')

@section('outer_css')
  <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('title', 'Dashboard')

@section('content')
<section class="content">
  <div class="row">
    <div class="col-sm-8">
      <h1>@lang('common.Social insurance management')</h1>
    </div>
  </div>

  <div class="row" id="app">
    <input type="hidden" ref="id" value="{{$id}}">
    <input type="hidden" ref="language" value="{{App::getLocale()}}">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          @lang('common.Social insurance details')
          <div class="pull-right">
            <a href="{{ route('socialInsurance.index') }}" type="button" class="btn btn-primary">@lang('Company_Admin/dashboard.Back')</a>
          </div>
        </div>
        <div class="panel-body">

          <div class="">

            <div class="form-group row">
              <div class="col-md-6">
                <label class="col-md-5" for="">
                  WAO Basic Prize :*
                </label>
                <div class="col-md-4">
                  <div class="form-group input-group">
                    <input type="number" min="0" max="100" class="form-control" v-model:value="socialInsurance.WAO_basic_prize" readonly>
                    <span class="input-group-addon">%</span>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <label class="col-md-5" for="">
                  WAO Calculate Prize :*</label>
                  <div class="col-md-4">
                    <div class="form-group input-group">
                      <input type="number" class="form-control" min="0" max="100" name="" v-model:value="socialInsurance.WAO_calculateprize" readonly>
                      <span class="input-group-addon">%</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label class="col-md-5" for="">
                    WGA Calculate Prize :*
                  </label>
                  <div class="col-md-4">
                    <div class="form-group input-group">
                      <input type="number" class="form-control" min="0" max="100" name="" v-model:value="socialInsurance.WGA_calculateprize" readonly>
                      <span class="input-group-addon">%</span>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <label class="col-md-5" for="">
                    Total Prize PEMBA/IVA :*</label>
                    <div class="col-md-4">
                      <div class="form-group input-group">
                        <input type="number" class="form-control" min="0" max="100" name="" v-model:value="total_prize" readonly>
                        <span class="input-group-addon">%</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label class="col-md-5" for="">
                      Unemployment law (W.W.) 1) :*
                    </label>
                    <div class="col-md-4">
                      <div class="form-group input-group">
                        <input type="number" class="form-control" min="0" max="100" name="" v-model:value="socialInsurance.Unemploymentlaw_ww1" readonly>
                        <span class="input-group-addon">%</span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label class="col-md-5" for="">
                      Redundancy Fund Incl Childcare :*</label>
                      <div class="col-md-4">
                        <div class="form-group input-group">
                          <input type="number" class="form-control" min="0" max="100" name="" v-model:value="socialInsurance.Redundancy_fund_incl_childcare" readonly>
                          <span class="input-group-addon">%</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-6">
                      <label class="col-md-5" for="">
                        Healthcare Law :*
                      </label>
                      <div class="col-md-4">
                        <div class="form-group input-group">
                          <input type="number" class="form-control" min="0" max="100" name="" v-model:value="socialInsurance.Healtcarelaw" readonly>
                          <span class="input-group-addon">%</span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label class="col-md-5" for="">
                        Pre-pension :*</label>
                        <div class="col-md-4">
                          <div class="form-group input-group">
                            <input type="number" class="form-control" min="0" max="100" name="" v-model:value="socialInsurance.Pre_pension" readonly>
                            <span class="input-group-addon">%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          AOP :*
                        </label>
                        <div class="col-md-4">
                          <div class="form-group input-group">
                            <input type="number" class="form-control" min="0" max="100" name="" v-model:value="socialInsurance.AOP_p" readonly>
                            <span class="input-group-addon">%</span>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          OP/NP pension 2) :*</label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                              <input type="number" class="form-control" min="0" max="100" name="" v-model:value="socialInsurance.OP_NP_pension_2" readonly>
                              <span class="input-group-addon">%</span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-6">
                          <label class="col-md-5" for="">
                            Pension Transitional Arrangement :*
                          </label>
                          <div class="col-md-4">
                            <div class="form-group input-group">
                              <input type="number" class="form-control" min="0" max="100" name="" v-model:value="socialInsurance.Pension_transitional_arrangement" readonly>
                              <span class="input-group-addon">%</span>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <label class="col-md-5" for="">
                            VUT Transitional Arrangement :*</label>
                            <div class="col-md-4">
                              <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="socialInsurance.VUT_transitional_arrangement" readonly>
                                <span class="input-group-addon">%</span>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="col-md-6">
                            <label class="col-md-5" for="">
                              Final levy VUT transitional arrangement :*
                            </label>
                            <div class="col-md-4">
                              <div class="form-group input-group">
                                <input type="number" class="form-control" min="0" max="100" name="" v-model:value="socialInsurance.Final_levy_VUT_transitional_arrangement" readonly>
                                <span class="input-group-addon">%</span>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <label class="col-md-5" for="">
                              O.R. (zie RAS heffing) :*</label>
                              <div class="col-md-4">
                                <div class="form-group input-group">
                                  <input type="number" class="form-control" min="0" max="100" name="" v-model:value="socialInsurance.O_R_zie_RAS_heffing" readonly>
                                  <span class="input-group-addon">%</span>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-md-6">
                              <label class="col-md-5" for="">
                                Childcare (zie resdundancy fund per 1-1-2011) :*
                              </label>
                              <div class="col-md-4">
                                <div class="form-group input-group">
                                  <input type="number" class="form-control" min="0" max="100" name="" v-model:value="socialInsurance.Childcare_zie_resdundancy_fund" readonly>
                                  <span class="input-group-addon">%</span>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <label class="col-md-5" for="">
                                RAS-charge :*</label>
                                <div class="col-md-4">
                                  <div class="form-group input-group">
                                    <input type="number" class="form-control" min="0" max="100" name="" v-model:value="socialInsurance.RAS_charge" readonly>
                                    <span class="input-group-addon">%</span>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="form-group row">
                              <div class="col-md-6">
                                <label class="col-md-5" for="">
                                  Total prize divers :*
                                </label>
                                <div class="col-md-4">
                                  <div class="form-group input-group">
                                    <input type="number" class="form-control" min="0" max="100" name="" v-model:value="total_prize_divers" readonly>
                                    <span class="input-group-addon">%</span>
                                  </div>
                                </div>
                              </div>

                              <div class="col-md-6">
                                <label class="col-md-5" for="">
                                  Totaal sociale insurances :*</label>
                                  <div class="col-md-4">
                                    <div class="form-group input-group">
                                      <input type="number" class="form-control" min="0" max="100" name="" v-model:value="socialInsurance.Totaal_sociale_insurances" readonly>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <!-- <script src="https://unpkg.com/vue-swal"></script> -->
    <script src="{{asset('js/lodash.min.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/vue.min.js')}}"></script>
    <script src="{{asset('js/vue-select-latest.js')}}"></script>
    <script src="{{asset('js/HourlyRate/social_insurance_edit.js')}}"></script>
  @endsection

<!-- Content Header (Page header) -->

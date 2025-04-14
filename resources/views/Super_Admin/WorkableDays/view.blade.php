@extends('Super_Admin.layouts.admin')

@section('outer_css')
  <link href="{{asset('public/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('title', 'Dashboard')

@section('content')
<section class="content">
  <div class="row">
    <div class="col-sm-8">
      <h1>@lang('common.Workable day management')</h1>
    </div>
  </div>

  <div class="row" id="app">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <input type="hidden" ref="id" value="{{$id}}">
        <input type="hidden" ref="language" value="{{App::getLocale()}}">
        <div class="panel-heading"> @lang('common.Workable day details')
          <div class="pull-right">
            <a href="{{ route('workableDaysCalculation.index') }}" type="button" class="btn btn-primary">@lang('Company_Admin/dashboard.Back')</a>
          </div>
        </div>
        <div class="panel-body">
          <div class="">

            <div class="form-group row">
              <div class="col-md-6">
                <label class="col-md-5" for="">
                  Number Of Calendar Days:*
                </label>
                <div class="col-md-4">
                  <div class="form-group input-group">
                    <input type="number" class="form-control" v-model:value="workableDays.number_of_calendar_days" readonly>
                    <span class="input-group-addon">%</span>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <label class="col-md-5" for="">
                  Weekend Days:*</label>
                  <div class="col-md-4">
                    <div class="form-group input-group">
                      <input type="number" class="form-control" min="0" name="" v-model:value="workableDays.weekend_days" readonly>
                      <span class="input-group-addon">%</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label class="col-md-5" for="">
                    Work Days a Year:*
                  </label>
                  <div class="col-md-4">
                    <div class="form-group input-group">
                      <input type="number" class="form-control" min="0" name="" v-model:value="work_days_a_year_comp" readonly>
                      <span class="input-group-addon">%</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label class="col-md-5" for="">
                    Net Hollydays, short absence:*
                  </label>
                  <div class="col-md-4">
                    <div class="form-group input-group">
                      <input type="number" class="form-control" min="0" name="" v-model:value="workableDays.nat_holydays_short_absence_bijz_CAO_value" readonly>
                      <span class="input-group-addon">%</span>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <label class="col-md-5" for="">
                    Holidays:*</label>
                    <div class="col-md-4">
                      <div class="form-group input-group">
                        <input type="number" class="form-control" min="0" name="" v-model:value="workableDays.holidays_value" readonly>
                        <span class="input-group-addon">%</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label class="col-md-5" for="">
                      Sickdays:*
                    </label>
                    <div class="col-md-4">
                      <div class="form-group input-group">
                        <input type="number" class="form-control" min="0" name="" v-model:value="workableDays.sickdays_value" readonly>
                        <span class="input-group-addon">%</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label class="col-md-5" for="">
                      Workable Days a Year:*
                    </label>
                    <div class="col-md-4">
                      <div class="form-group input-group">
                        <input type="number" class="form-control" min="0" name="" v-model:value="workable_days_a_year_comp" readonly>
                        <span class="input-group-addon">%</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label class="col-md-5" for="">
                      Net Hollydays, short absence Percentage:*</label>
                      <div class="col-md-4">
                        <div class="form-group input-group">
                          <input type="number" class="form-control" min="0" readonly name="" v-model:value="nat_holydays_short_absence_bijz_CAO_comp">
                          <span class="input-group-addon">%</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-6">
                      <label class="col-md-5" for="">
                        Holidays Percentage:*</label>
                        <div class="col-md-4">
                          <div class="form-group input-group">
                            <input type="number" class="form-control" min="0" readonly name="" v-model:value="holidays_comp">
                            <span class="input-group-addon">%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Sickdays Percentage:*
                        </label>
                        <div class="col-md-4">
                          <div class="form-group input-group">
                            <input type="number" class="form-control" min="0" name="" v-model:value="sickdays_comp" readonly>
                            <span class="input-group-addon">%</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label class="col-md-5" for="">
                          Rage unworkable days in Percentage:*
                        </label>
                        <div class="col-md-4">
                          <div class="form-group input-group">
                            <input type="number" class="form-control" min="0" name="" v-model:value="rage_unworkable_days_in_comp" readonly>
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
    <script src="{{asset('public/js/vue.min.js')}}"></script>
    <script src="https://unpkg.com/vue-swal"></script>
    <script src="{{asset('public/js/lodash.min.js')}}"></script>
    <script src="{{asset('public/js/axios.min.js')}}"></script>
    <script src="{{asset('public/js/vue-select-latest.js')}}"></script>
    <script src="{{asset('public/js/HourlyRate/workDays/workDays_edit.js')}}"></script>
  @endsection

<!-- Content Header (Page header) -->

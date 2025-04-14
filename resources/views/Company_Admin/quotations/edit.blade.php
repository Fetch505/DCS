@extends('Company_Admin.layouts.main')

@section('outer_css')
  <link href="{{asset('public/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
  <style>
    [v-cloak] {
      display: none;
    }
  </style>
@endsection

@section('title', 'Dashboard')

  <div id="wrapper">
    @section('content')
    <div class="row">
      <div class="col-sm-8">
      <h1>@lang('Company_Admin/dashboard.Quotation') @lang('Company_Admin/dashboard.Management')</h1>
      </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('Company_Admin/dashboard.Edit') @lang('Company_Admin/dashboard.Quotation')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <div id="app">

                    <div v-if="errors.length > 0" class="alert alert-danger">
                      <ul>
                        <li v-for="error in errors">@{{ error }}</li>
                      </ul>
                    </div>
                    <form @submit.prevent="submitForm">
                      <div class="form-group row">
                        <label class="col-md-2" for="company_name">@lang('Company_Admin/dashboard.Company') @lang('Company_Admin/dashboard.Name'):*</label>
                        <div class="col-md-4">
                          <input type="text" v-model="quotation.company_name" class="form-control" id="company_name" placeholder="Enter company name" required>
                        </div>

                        <label class="col-md-2" for="poc">@lang('Company_Admin/dashboard.Point Of Contact')</label>
                        <div class="col-md-4">
                          <input type="text" v-model="quotation.poc" class="form-control" id="poc" placeholder="Enter point of contact" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-2" for="address">@lang('Company_Admin/dashboard.Address')</label>
                        <div class="col-md-4">
                            <input type="text" v-model="quotation.address" class="form-control" id="address" placeholder="Enter address" required>
                        </div>
                        
                        <label class="col-md-2" for="phone_number">@lang('Company_Admin/dashboard.Phone')</label>
                        <div class="col-md-4">
                            <input type="text" v-model="quotation.phone_number" class="form-control" id="phone_number" placeholder="Enter phone number" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-2" for="rate_type">@lang('Company_Admin/dashboard.Rate') @lang('Company_Admin/dashboard.Type')</label>
                        <div class="col-md-4">
                          <select v-model="quotation.rate_type" class="form-control" required>
                            <option value="hourly">Hourly</option>
                            <option value="monthly">Monthly</option>
                          </select>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-2 text-right">
                          <button type="button" class="btn btn-primary" @click="addItem">@lang('Company_Admin/dashboard.Add') Item</button>
                        </div>
                      </div>

                      <table  width="100%" id="table" class="table table-bordered table-striped table-hover">
                          <thead>
                              <tr>
                                  <th>@lang('Company_Admin/dashboard.Worker') @lang('Company_Admin/dashboard.Type')</th>
                                  <th>@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Workers')</th>
                                  <th v-if="quotation.rate_type === 'monthly'">@lang('Company_Admin/dashboard.monthly_rate') €</th>
                                  <th v-if="quotation.rate_type === 'hourly'">@lang('Company_Admin/dashboard.hourly_rate') €</th>
                                  <th v-if="quotation.rate_type === 'hourly'">@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Hours_per_worker')</th>
                                  <th>% @lang('Company_Admin/dashboard.Discount')</th>
                                  <th>@lang('Company_Admin/dashboard.Net') @lang('Company_Admin/dashboard.Rate') €</th>
                                  <th>@lang('Company_Admin/dashboard.Price') €</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="(item, index) in items" :key="index">
                                  <td>
                                      <select v-model="item.worker_type_id" class="form-control" required>
                                        <option value="" disabled selected>Select Worker Type</option>
                                        <option v-for="workerType in workerTypes" :value="workerType.id">@{{ workerType.name }}</option>
                                      </select>
                                  </td>
                                  <td>
                                      <input type="number" v-model="item.total_workers" class="form-control" placeholder="Enter Total Workers" min=1 required>
                                  </td>
                                  <td>
                                      <input type="number" v-model="item.rate" class="form-control" placeholder="Enter rate" step="0.01">
                                  </td>
                                  <td v-if="quotation.rate_type === 'hourly'">
                                      <input type="number" v-model="item.total_hours_per_worker" class="form-control" placeholder="Enter total hours" step="0.01">
                                  </td>
                                  <td>
                                      <input type="number" v-model="item.discount" class="form-control" placeholder="Enter discount" step="0.01">
                                  </td>
                                  <td>
                                      @{{ calculateItemPrice(item) }}
                                  </td>
                                  <td>
                                      @{{ item.price }}
                                  </td>
                              </tr>
                              <tr v-if="quotation.rate_type === 'hourly'">
                                  <td colspan="6" class="text-right"><strong>Total:</strong></td>
                                  <td>€@{{ calculateTotalPrice() }}</td>
                              </tr>
                              <tr v-if="quotation.rate_type === 'monthly'">
                                  <td colspan="5" class="text-right"><strong>Total:</strong></td>
                                  <td>€@{{ calculateTotalPrice() }}</td>
                              </tr>
                          </tbody>
                      </table>

                      <div class="inline pull-right">
                        <button type="submit" class="btn btn-success">@lang('Company_Admin/dashboard.Update')</button>
                        <a href="{{ route('quotations.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
                      </div>

                    </form>
                  </div>                  
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    @endsection
  </div>

  @section('outer_script')
  <script src="{{asset('public/select2/dist/js/select2.min.js')}}"></script>
  <script src="{{asset('public/js/axios.min.js')}}"></script>
  <script src="{{asset('public/js/vue-select-latest.js')}}"></script>
  <script src="{{asset('public/js/vue.min.js')}}"></script>
  <script>
    var data = {
      quotation: {!! json_encode($quotation) !!},
      workerTypes: {!! json_encode($workerTypes) !!}
    };
  </script>
  <script src="{{asset('public/js/Quotations/edit.js')}}"></script>
  @endsection

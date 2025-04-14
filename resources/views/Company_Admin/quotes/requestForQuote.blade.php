@extends('Company_Admin.layouts.main')


@section('outer_css')
<style src="{{asset('public/select2/dist/css/select2.min.css')}}"></style>
<link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
<link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">

<style media="screen">
  [v-cloak] {
    display: none;
  }
</style>
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
@endsection

@section('title', 'Dashboard')

  <div id="wrapper">
      @section('content')
   <div id="quotes" v-cloak>
      <div class="row">
        <div class="col-sm-8">
          <h1>@lang('Company_Admin/dashboard.Project') @lang('Company_Admin/dashboard.Material') @lang('Company_Admin/dashboard.Quote')</h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-info">
            <div class="panel-heading">
              <div class="row">
                <div class="col-md-10">
                  @lang('Company_Admin/dashboard.Add') @lang('Company_Admin/dashboard.Material')
                </div>
                <div class="col-sm-2">
                  <!-- <button class="btn btn-success btn-sm" type="button" name="button" @click.prevent="newRequest">RFQ</button> -->
                </div>
              </div>

            </div>

            <div class="panel-body">

            <div class="row col-md-offset-2">
              <div class="col-md-2">
                <label for="">@lang('Company_Admin/dashboard.Project')</label>
              </div>
              <div class="col-md-6">
                <input type="hidden" ref="project_id" value="{{$project->id}}">
                <input type="text" readonly class="form-control" value="{{$project->name}}">
              </div>
            </div>
            <br>
            <div class="row col-md-offset-2">
              <div class="col-md-2">
                <label for="">@lang('Company_Admin/dashboard.Material')</label>
              </div>
              <div class="col-md-6">
                <v-select :options="materials"  label="name" v-model="material"  placeholder="Select Material">
                </v-select>
              </div>
            </div>
            <br>
            <div class="row col-md-offset-2">
              <div class="col-md-2">
                <label for="">@lang('Company_Admin/dashboard.Quantity')</label>
              </div>
              <div class="col-md-6">
                <input type="number" min="0" class="form-control" name="" v-model="quantity">
              </div>
            </div>

            <br>
            <div class="">
              <button type="button" class="btn btn-success pull-right" name="button" @click.prevent="addToCart">@lang('Company_Admin/dashboard.Add')</button>
            </div>

          </div>
        </div>
      </div>
    </div>

    <br>
      <div class="row" v-if="items.length > 0">
        <div class="col-lg-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="row">
                <div class="col-md-10">
                  @lang('Company_Admin/dashboard.Cart')
                </div>
                <div class="col-sm-2">
                </div>
              </div>
            </div>

            <div class="panel-body">
              <div class="">
                <table class="table table-bordered table-striped">
                  <thead>
                    <th>Sr#</th>
                    <th>@lang('Company_Admin/dashboard.Material')</th>
                    <th>@lang('Company_Admin/dashboard.Quantity')</th>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in items">
                      <td>@{{++index}}</td>
                      <td>@{{item.material_name}}</td>
                      <td>@{{item.quantity}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <br>
              <div class="">
                <button type="button" class="btn btn-info pull-right" name="button" @click.prevent="placeOrder">@lang('Company_Admin/dashboard.Place Order')</button>
              </div>
           </div>
        </div>
      </div>
    </div>

  </div>
  <!-- vue ends here -->
    @endsection
  </div>


  @section('outer_script')

  <script src="{{asset('public/select2/dist/js/select2.min.js')}}"></script>
  <script src="{{asset('public/js/lodash.min.js')}}"></script>
  <script src="{{asset('public/js/axios.min.js')}}"></script>
  <script src="{{asset('public/js/vue.min.js')}}"></script>
  <!-- <script src="{{asset('public/js/vue-swal.js')}}"></script> -->
  <script src="https://unpkg.com/vue-swal"></script>
  <script src="{{asset('public/js/vue-select-latest.js')}}"></script>
  <script src="{{asset('public/js/quotes/RFQ.js')}}"></script>

  @endsection
<!-- Content Header (Page header) -->

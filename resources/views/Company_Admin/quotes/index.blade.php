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
                  @lang('Company_Admin/dashboard.List Of All') @lang('Company_Admin/dashboard.Projects')
                </div>
                <div class="col-sm-2">

                </div>
              </div>

            </div>
            <div class="panel-body">
              <div class="col-md-8 col-md-offset-2">
                <v-select :options="projects" @input="projectChanged" label="name" v-model="project"  placeholder="Select Project">
              </v-select>
            </div>
          </div>
        </div>
      </div>
    </div>


      <div class="row" v-if="show">
        <div class="col-lg-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="row">
                <div class="col-md-10">
                  @lang('Company_Admin/dashboard.List Of All') @lang('Company_Admin/dashboard.Quotes')
                </div>
                <div class="col-sm-2">
                  <a class="btn btn-success btn-sm" @click.prevent="makeQuote">@lang('Company_Admin/dashboard.RFQ')</a>
                </div>
              </div>
            </div>

            <div class="panel-body">
              <template v-if="materialList.length > 0">
                <table class="table table-bordered table-striped">
                  <thead>
                    <th>@lang('Company_Admin/dashboard.Sr #')</th>
                    <th>@lang('Company_Admin/dashboard.Material') @lang('Company_Admin/dashboard.Name')</th>
                    <th>@lang('Company_Admin/dashboard.Material') @lang('Company_Admin/dashboard.Quantity')</th>
                    <th>@lang('Company_Admin/dashboard.Order') @lang('Company_Admin/dashboard.Date')</th>
                  </thead>
                  <tbody>
                    <tr v-for="(quote,index) in materialList">
                      <td>@{{++index}}</td>
                      <td>@{{quote.material_name}}</td>
                      <td>@{{quote.material_quantity}}</td>
                      <td>@{{quote.date}}</td>
                    </tr>
                  </tbody>
                </table>
              </template>

              <template v-else>
                <div style="color:red;">
                  <h3>No Data to Show</h3>
                </div>
              </template>
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
  <script src="{{asset('public/js/vue-select-latest.js')}}"></script>
  <script src="{{asset('public/js/quotes/quotesIndex.js')}}"></script>

  @endsection
<!-- Content Header (Page header) -->

@extends('Company_Admin.layouts.main')

@section('outer_css')
  <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
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
        <h1>@lang('common.Material Order Management')</h1>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  @lang('Company_Admin/dashboard.Order') @lang('Company_Admin/dashboard.Materials')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <div id="order_materials">

                    <div v-if="errors.length > 0" class="alert alert-danger">
                      <ul>
                        <li v-for="error in errors">@{{ error }}</li>
                      </ul>
                    </div>

                    <div v-if="successMessage" class="alert alert-success">
                      @{{ successMessage }}
                    </div>

                    <div class="form-group row">
                      <div class="col-md-3">
                        <label for="material_category">@lang('Common.Category'):</label>
                        <select v-model="selectedCategory" class="form-control" @change="filterMaterialTypes">
                            <option value="" disabled>Select Material Category</option>
                            <option v-for="category in materialCategories" :value="category.id">@{{ category.name }}</option>
                        </select>
                      </div>

                      <div class="col-md-3">
                        <label for="material_type">@lang('Company_Admin/dashboard.Type'):</label>
                        <select v-model="selectedType" class="form-control" @change="filterMaterials">
                            <option value="" disabled>Select Material Type</option>
                            <option v-for="type in materialTypes" :value="type.id">@{{ type.name }}</option>
                        </select>
                      </div>

                      <div class="col-md-3">
                        <label for="materials">@lang('Company_Admin/dashboard.Materials'):</label>
                        <select v-model="selectedMaterials" class="form-control" multiple>
                            <option value="" disabled>Select Materials</option>
                            <option v-for="material in materials" :value="material">@{{ material.name }}</option>
                        </select>
                      </div>

                      <div class="col-md-1">
                          <br>
                          <button class="form-control btn btn-primary" style="width: 80px; margin-top: 4px;" @click="addSelectedMaterials">+Add</button>
                      </div>
                    </div>
                    <form @submit.prevent="assignMaterials">
                      <div class="form-group row" v-if="orderMaterials.length > 0">
                        <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Name')</label>
                        <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Quantity')</label>
                        <label class="col-md-3" for="">@lang('Company_Admin/dashboard.Project')</label>
                        <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Supplier')</label>
                      </div>

                      <div class="form-group row" v-for="(material, index) in orderMaterials" :key="index">
                        <p class="col-md-2">@{{ material.name }}</p>
                        <div class="col-md-2">
                          <input class="form-control" type="number" v-model="material.orderQuantity" :min="0">
                        </div>
                        <div class="col-md-3">
                          <select v-model="material.project" class="form-control">
                            <option value="">SELECT PROJECT</option>
                            <option v-for="project in projects" :value="project">@{{ project.name }}</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <select v-model="material.supplier" class="form-control" required>
                            <option v-for="supplier in material.suppliers" :value="supplier">@{{ supplier.name }}</option>
                          </select>
                        </div>
                        <i class="col-md-1 fa fa-minus" style="color:red" @click="removeMaterial(index)"></i>
                      </div>

                      <div class="form-group row" v-if="orderMaterials.length > 0">
                        <p class="col-md-2">@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Quantity'):</p>
                        <p class="col-md-2"> @{{ getTotalQuantity }}</p>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-3 pull-right">
                          <button v-if="orderMaterials.length > 0" type="submit" class="btn btn-success" :disabled="isAssignDisabled">@lang('Company_Admin/dashboard.Order')</button>
                          <a href="{{ route('showMaterialOrders') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
                        </div>
                      </div>
                    </form>
                    <!-- /.form -->
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
  <script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
  <script src="{{asset('js/axios.min.js')}}"></script>
  <script src="{{asset('js/vue-select-latest.js')}}"></script>
  <script src="{{asset('js/vue.min.js')}}"></script>
  <script>
     var categories = @json($categories);
     var projects = @json($projects);
  </script>
  <script src="{{asset('js/order_materials.js')}}"></script>
  <script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
  </script>
  @endsection

<!-- Content Header (Page header) -->

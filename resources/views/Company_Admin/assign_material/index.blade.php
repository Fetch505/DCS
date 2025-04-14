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
        <h1>@lang('common.Projects Management')</h1>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     {{$project->name}}
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <div id="assign_material">

                    <div v-if="errors.length > 0" class="alert alert-danger">
                      <ul>
                        <li v-for="error in errors">@{{ error }}</li>
                      </ul>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-2" for="fileInput">Goods Receipt</label>
                      <input type="file" id="fileInput" class="col-md-10" @change="handleFileUpload">
                    </div>

                    <div class="form-group row">
                      <div class="col-md-3">
                        <label for="material_category">@lang('Common.Category'):</label>
                        <select v-model="selectedCategory" class="form-control" @change="populateTypes">
                            <option value="" disabled>Select Material Category</option>
                            <option v-for="category in materialCategories" :value="category.id">@{{ category.name }}</option>
                        </select>
                      </div>

                      <div class="col-md-3">
                        <label for="material_type">@lang('Company_Admin/dashboard.Type'):</label>
                        <select v-model="selectedType" class="form-control" @change="populateMaterials">
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

                    <div class="form-group row" v-if="assigingMaterials.length > 0">
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Name')</label>
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Quantity')</label>
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Consumption')</label>
                    </div>

                    <div class="form-group row" v-for="(material, index) in assigingMaterials" :key="index">
                      <p class="col-md-2">@{{ material.name }}</p>
                      <div class="col-md-2">
                        <div class="row">
                          <input class="col-md-6" type="number" v-model="material.assignQuantity" :min="0" :max="material.quantity">
                          <p class="col-md-6">/ @{{ material.quantity }}</p>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="row" v-if="material.consumable">
                          <input class="col-md-4" type="number" v-model="material.consumption" :min="0" :disabled="!material.editing">
                          <p class="col-md-4">/ Day</p>
                          <i class="col-md-4 fa fa-pencil" style="color:green;" @click="editMaterial(index)"></i>
                        </div>
                      </div>
                      <i class="col-md-1 fa fa-minus" style="color:red" @click="removeMaterial(index)"></i>
                      <div class="col-md-3">
                      </div>
                    </div>

                    <div class="form-group row" v-if="assigingMaterials.length > 0">
                      <p class="col-md-2">@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Quantity'):</p>
                      <p class="col-md-2"> @{{ getTotalQuantity }}</p>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-3 pull-right">
                        <button v-if="assigingMaterials.length > 0" class="btn btn-success" @click="assignMaterials" :disabled="isAssignDisabled">@lang('Company_Admin/dashboard.Assign')</button>
                        <a href="{{route('project.show',$project->id)}}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
                      </div>
                    </div>
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
  <script src="{{asset('public/select2/dist/js/select2.min.js')}}"></script>
  <script src="{{asset('public/js/axios.min.js')}}"></script>
  <script src="{{asset('public/js/vue-select-latest.js')}}"></script>
  <script src="{{asset('public/js/vue.min.js')}}"></script>
  <script>
    var projectId = {{ $project->id }};
    var materialData = {
        materialCategories: {!! json_encode($materialCategories) !!},
        materialTypes: {!! json_encode($materialTypes) !!},
        materials: {!! json_encode($materials) !!}
    };
  </script>
  <script src="{{asset('public/js/assign_material.js')}}"></script>
  <script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
  </script>
  @endsection

<!-- Content Header (Page header) -->

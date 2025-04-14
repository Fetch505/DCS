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
            <h2>{{$material->name}}</h2>
            <div id="assign_user">
              
              <div v-if="errors.length > 0" class="alert alert-danger">
                <ul>
                  <li v-for="error in errors">@{{ error }}</li>
                </ul>
              </div>

              <div class="form-group row">
                <div class="col-md-3">
                  <label for="users">@lang('Company_Admin/dashboard.Users'):</label>
                  <select v-model="selectedUsers" class="form-control" multiple>
                    <option v-for="user in users" :value="user">@{{ user.name }}</option>
                  </select>
                </div>

                <div class="col-md-1">
                    <br>
                    <!-- <button class="form-control btn btn-primary" style="width: 80px; margin-top: 4px;" @click="addSelectedUsers">+Add</button> -->
                </div>
              </div>

              <form @submit.prevent="submitForm">
                <div class="form-group row">
                  <div class="col-md-6">
                    <div class="row" v-if="has_usage">
                      <label class="col-md-6" for="usage_limit">Usage Days:</label>
                      <input class="col-md-4" type="number" name="usage_limit" id="usage_limit" v-model="usageLimit" min="1">
                      <label class="col-md-2" >Days</label>
                    </div>
                  </div>
                  <div class="col-md-3 pull-right">
                    <button type="submit" class="btn btn-primary">Assign</button>
                    <a href="{{route('project.show',$project->id)}}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3" >Users</label>
                  <label class="col-md-2" >Quantity</label>
                  <label class="col-md-2" >Assigned Quantity</label>
                </div>
                <div class="form-group row" v-for="(user, index) in selectedUsers" :key="index">
                  <p class="col-md-3">@{{ user.name }}</p>
                  <input class="col-md-2" type="number" :name="'quantity_' + index" v-model="user.quantity" min="1">
                  <p class="col-md-3">@{{ user.assignedQuantity }}</p>

                </div>

                <div class="form-group row">
                  <p class="col-md-2">@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Quantity'):</p>
                  <p class="col-md-2"> @{{ getTotalQuantity }} / @{{ availableQuantity }}</p>
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
    var projectId = {{ $project->id }};
    var MaterialId = {{ $material->id }};
    var usage = {{ $material->usage }};
    var availableQuantity = {{ $availableQuantity }};
    var users = @json($users);
  </script>
  <script src="{{asset('js/assign_user.js')}}"></script>

  @endsection

<!-- Content Header (Page header) -->

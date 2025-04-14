@extends('Company_Admin.layouts.main')

@section('outer_css')
  <link href="{{asset('public/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('title', 'Dashboard')

@section('content')
  <section class="content">
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Tasks Management')</h1>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  @lang('common.Add new task')
                </div>
                <div class="panel-body">
                  <div class="">
                    {{ Form::open(['route' => 'task.store', 'method' => 'POST', 'data-parsley-validate' => '']) }}
                    <div class="form-group row">
                      <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Element'):*</label>
                        <div class="col-md-8">
                          {{ Form::select('element_id',$elements->pluck('name','id') , null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Task') @lang('Company_Admin/dashboard.Name'):*</label>
                          <div class="col-md-8">
                            {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                          </div>
                        </div>
                        <!--div class="form-group row">
                          <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Task') @lang('Company_Admin/dashboard.Name'):*</label>
                            <div class="col-md-8">
                              {{ Form::text('name_eng', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                              {{ __('(English)') }}
                            </div>
                          </div-->
                        <div class="form-group row">
                          <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Description'):*</label>
                          <div class="col-md-8">
                            {{ Form::text('description', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                          </div>
                        </div>
                        <!--div class="form-group row">
                          <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Description'):*</label>
                          <div class="col-md-8">
                            {{ Form::text('description_eng', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                            {{ __('(English)') }}
                          </div>
                        </div-->
                        <div class="inline pull-right">
                          <button type="submit" class="btn btn-success">@lang('Company_Admin/dashboard.Add')</button>
                          <a href="{{ route('task.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
                        </div>
                    {{ Form::close() }}
                  </div>
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection

  @section('outer_script')
  <script src="{{asset('public/select2/dist/js/select2.min.js')}}"></script>

  <script type="text/javascript">
  $(document).ready(function(){

    $('#customer_select').select2();
    $('#project').select2();
    $('#area').select2();
    $('#multi-select4').select2();
    $('#material-select').select2();

    $('#customer_select').change(function(){
      var id = $(this).val();
      console.log($(this).val());

      $.ajax({
      type: "GET",
      url: APP_URL + "/task/getProjects/"+id,
      data: {id:id},
      cache: false,
      success: function(data){
         console.log(data);
         $('#project').find('option').remove()
         $('#project').append('<option value="">Select Project</option>');
         for (var i = 0; i <= data.length; i++) {
                 $('#project').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
             }
      }
    });
  });// customer select function


  $('#project').change(function(){
    var id = $(this).val();
    console.log($(this).val());

    $.ajax({
    type: "GET",
    url: APP_URL + "/task/getAreas/"+id,
    data: {id:id},
    cache: false,
    success: function(data){
       console.log(data);
       $('#area').find('option').remove()
       $('#area').append('<option value="">Select Area</option>');
       for (var i = 0; i <= data.length; i++) {
               $('#area').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
           }
    }
  });
  });
    //init data




    });
  </script>

  @endsection

<!-- Content Header (Page header) -->

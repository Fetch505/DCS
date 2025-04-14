@extends('Super_Admin.layouts.admin')

@section('outer_css')
  <link href="{{asset('public/multiple-select/multiple-select.css')}}" rel="stylesheet"/>
@endsection

@section('title', 'Dashboard')

<div id="wrapper">
  @section('content')
  <div id="app" v-cloak>

    <input type="hidden" ref="language" value="{{App::getLocale()}}">
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Health Category Management')</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            @lang('common.Add new')
          </div>
          <div class="panel-body">
            <form action="{{ route('healthCategory.store') }}" method="POST">
            @csrf

              <div class="form-group row">
                <label class="col-md-2" for="">@lang('Company_Admin/dashboard.Name'):*</label>
                <div class="col-md-8">
                <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
                  @if ($errors->has('name'))
                      <span class="invalid-feedback" role="alert">
                          {{ $errors->first('name') }}
                      </span>
                  @endif
                </div>
              </div>

              <div class="inline pull-right">
                <button type="submit" class="btn btn-success">@lang('Company_Admin/dashboard.Add')</button>
                <a href="{{ route('healthCategory.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
</div>

  @section('outer_script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <script src="{{asset('public/js/vue.min.js')}}"></script>
  <script src="{{asset('public/js/test/dist/vue-phone-number-input.umd.min.js')}}" charset="utf-8"></script>
  <script type="text/javascript">

  </script>
  <script src="{{asset('public/select2/dist/js/select2.min.js')}}"></script>
  <script src="{{asset('public/js/lodash.min.js')}}"></script>
  <script src="{{asset('public/js/axios.min.js')}}"></script>
  <script src="{{asset('public/js/vue-select-latest.js')}}"></script>
  <script src="{{asset('public/js/vue.min.js')}}"></script>

  <script src="https://unpkg.com/vue-swal"></script>
  @endsection

<!-- Content Header (Page header) -->

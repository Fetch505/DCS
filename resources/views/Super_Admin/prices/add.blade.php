@extends('Super_Admin.layouts.admin')

@section('outer_css')
    <link href="{{asset('/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('title', 'Dashboard')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-sm-8">
                <h1> Add Module Price
{{--                    @lang('common.Floor Types Management')--}}
                </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add Module Price
{{--                        @lang('common.Add new floor type')--}}
                    </div>
                    <div class="panel-body">
                        <div class="">
                            {{ Form::open(['route' => 'modulePrice.store', 'method' => 'POST', 'data-parsley-validate' => '']) }}

                            <div class="form-group row">
                                <label class="col-md-2" for="">
                                    Name:*
{{--                                    @lang('Company_Admin/dashboard.Type'):*--}}
                                </label>
                                <div class="col-md-8">

                                    {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2" for="">
                                    Dutch Name:*
                                    {{--                                    @lang('Company_Admin/dashboard.Type'):*--}}
                                </label>
                                <div class="col-md-8">

                                    {{ Form::text('dutch', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2" for="">
                                    Monthly Price:*
{{--                                    @lang('Company_Admin/dashboard.Type'):*--}}
                                </label>
                                <div class="col-md-8">
                                    {{ Form::number('monthly', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2" for="">
                                    Annually Price:*
{{--                                    @lang('Company_Admin/dashboard.Type'):*--}}
                                </label>
                                <div class="col-md-8">
                                    {{ Form::number('yearly', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2" for="">
                                    Monthly Discount:*
                                    {{--                                    @lang('Company_Admin/dashboard.Type'):*--}}
                                </label>
                                <div class="col-md-8">
                                    {{ Form::number('monthly_discount', 0, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2" for="">
                                    Annually Discount:*
                                    {{--                                    @lang('Company_Admin/dashboard.Type'):*--}}
                                </label>
                                <div class="col-md-8">
                                    {{ Form::number('discount', 0, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
                                </div>
                            </div>



                            <div class="inline pull-right">
                                <button type="submit" class="btn btn-success">@lang('Company_Admin/dashboard.Add')</button>
                                <a href="{{ route('modulePrice.index') }}" type="button" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
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
    <script src="{{asset('/select2/dist/js/select2.min.js')}}"></script>
    <script>
        $('#multi-select').select2();
    </script>
@endsection

<!-- Content Header (Page header) -->

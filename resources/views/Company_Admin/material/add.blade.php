@extends('Company_Admin.layouts.main')

@section('outer_css')
    <link href="{{ asset('select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/parsleyjs/src/parsley.css" rel="stylesheet" />
@endsection

@section('title', 'Dashboard')

<div id="wrapper">
    @section('content')
        <div class="row">
            <div class="col-sm-8">
                <h1>@lang('Company_Admin/dashboard.Materials') @lang('Company_Admin/dashboard.Management')</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @lang('Company_Admin/dashboard.Add') @lang('Company_Admin/dashboard.New') @lang('Company_Admin/dashboard.Material')
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['route' => 'material.store', 'method' => 'POST', 'data-parsley-validate' => '', 'autocomplete' => 'off']) }}
                        @csrf

                        {{-- Category --}}
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">
                                @lang('common.Category'): <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-8">
                                <select id="material_category" name="material_category" class="form-control" required
                                    onchange="populateTypes(this.value)"
                                    data-parsley-required-message="Please select a material category.">
                                    <option selected disabled value="">Select Material Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Type --}}
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">
                                @lang('Company_Admin/dashboard.Type'): <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-8">
                                <select id="material_type" name="material_type" class="form-control" required
                                    data-parsley-required-message="Please select a material type.">
                                    <option selected disabled value="">Select Material Type</option>
                                </select>
                            </div>
                        </div>

                        {{-- Material Name --}}
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">
                                @lang('Company_Admin/dashboard.Material') @lang('Company_Admin/dashboard.Name'): <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-8">
                                {{ Form::text('name', null, [
                                    'class' => 'form-control',
                                    'required' => '',
                                    'maxlength' => '255',
                                    'placeholder' => 'Enter material name',
                                    'aria-required' => 'true',
                                ]) }}
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">
                                @lang('Company_Admin/dashboard.Price'): <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-8">
                                {{ Form::number('price', 0, [
                                    'class' => 'form-control',
                                    'required' => '',
                                    'maxlength' => '255',
                                    'min' => 0,
                                    'placeholder' => 'Enter material price',
                                    'aria-required' => 'true',
                                ]) }}
                            </div>
                        </div>

                        {{-- Quantity --}}
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">
                                @lang('Company_Admin/dashboard.Unassigned') @lang('Company_Admin/dashboard.Quantity'):
                            </label>
                            <div class="col-md-8">
                                {{ Form::number('quantity', 0, [
                                    'class' => 'form-control',
                                    'min' => 0,
                                    'placeholder' => 'Enter quantity',
                                ]) }}
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">
                                @lang('Company_Admin/dashboard.Suppliers'): <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-8" id="supplier-selects-container">
                                <div class="mb-2 supplier-select">
                                    <select name="suppliers[]" class="form-control" required
                                        data-parsley-required-message="Please select a supplier.">
                                        <option value="" disabled selected>Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>

                        {{-- Buttons --}}
                        <div class="form-group row">
                            <div class="col-md-10 text-right">
                                <button type="submit" class="btn btn-success">@lang('Company_Admin/dashboard.Add')</button>
                                <a href="{{ route('material.index') }}" class="btn btn-danger">@lang('Company_Admin/dashboard.Cancel')</a>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    @endsection
</div>

@section('outer_script')
    <script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/parsleyjs"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: "Select suppliers",
                allowClear: true,
                width: '100%'
            });

            // Custom Parsley validation for select2 multi
            $('form').on('submit', function() {
                let selected = $('#suppliers').val();
                if (!selected || selected.length === 0) {
                    $('#supplier-error').text("Please select at least one supplier.");
                    return false;
                } else {
                    $('#supplier-error').text("");
                }
            });
        });

        function populateTypes(categoryId) {
            $.ajax({
                url: APP_URL + '/getMaterialTypes/' + categoryId,
                method: 'GET',
                success: function(data) {
                    var options = '<option selected disabled>Select Material Type</option>';
                    if (Object.keys(data).length === 0) {
                        options += '<option disabled>No types found for selected category</option>';
                    } else {
                        $.each(data, function(key, value) {
                            options += '<option value="' + key + '">' + value + '</option>';
                        });
                    }
                    $('#material_type').html(options);
                },
                error: function(xhr) {
                    console.log('Failed to load material types', xhr);
                }
            });
        }
    </script>
@endsection

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuotationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quotation.company_name' => 'required',
            'quotation.poc' => 'required',
            'quotation.address' => 'required',
            'quotation.phone_number' => 'required',
            'quotation.rate_type' => 'required|in:hourly,monthly',
            'quotation.total_price' => 'required|numeric|min:0',
            'items.*' => 'required',
            'items.*.worker_type_id' => 'required|exists:worker_types,id',
            'items.*.total_workers' => 'required|numeric|min:1',
            'items.*.rate' => 'required|numeric|min:0',
            'items.*.total_hours_per_worker' => 'required_if:quotation.rate_type,hourly|numeric|min:0',
            'items.*.discount' => 'required|numeric|min:0|max:100',
            'items.*.net_rate' => 'required|numeric|min:0',
            'items.*.price' => 'required|numeric|min:0',
        ];
    }
    public function messages()
    {
        return [
            'items.*.worker_type_id.required' => 'The worker type field is required.',
            'items.*.worker_type_id.exists' => 'The selected worker type is invalid.',
            'items.*.total_workers.required' => 'The total workers field is required.',
            'items.*.total_workers.numeric' => 'The total workers field must be a number.',
            'items.*.total_workers.min' => 'The total workers field must be at least 1.',
            'items.*.rate.required' => 'The rate field is required.',
            'items.*.rate.numeric' => 'The rate field must be a number.',
            'items.*.rate.min' => 'The rate field must be greater than or equal to 0.',
            'items.*.total_hours_per_worker.required_if' => 'The total hours per worker field is required when the rate type is hourly.',
            'items.*.total_hours_per_worker.numeric' => 'The total hours per worker field must be a number.',
            'items.*.total_hours_per_worker.min' => 'The total hours per worker field must be greater than or equal to 0.',
            'items.*.discount.required' => 'The discount field is required.',
            'items.*.discount.numeric' => 'The discount field must be a number.',
            'items.*.discount.min' => 'The discount field must be greater than or equal to 0.',
            'items.*.discount.max' => 'The discount field must be less than or equal to 100.',
        ];
    }
}

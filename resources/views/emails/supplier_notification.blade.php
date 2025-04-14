@component('mail::message')
# Material Order

Dear {{ $supplierName }},

Please find below the list of materials ordered:

| Material      | Quantity      | Location      |
|---------------|---------------|---------------|
@foreach ($materials as $material)
| {{ $material['name'] }}          | {{ $material['quantity'] }}          | {{ $material['location'] }}          |
@endforeach

Thanks,<br>
{{ config('app.name') }}
@endcomponent
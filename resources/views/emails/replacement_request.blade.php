@component('mail::message')
# Hello **{{ $emp_agency }}**,

This email is shared with you to inform you that we need replacement of Mr **{{ $emp_name }}**@if($type == 'holiday leaves') as he is going on {{ $type }} from **{{ date('dS M Y', strtotime($fromDate)) }}** - **{{ date('dS M Y', strtotime($toDate)) }}**.

@else
. Mr **{{ $emp_name }}** has forwareded his {{ $type }} request.

@endIf

Mr **{{ $emp_name }}** is currently working on {{ $project_name }} located at {{ $project_address }}.

## Supervisor's comment:

{{ $remarks }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# Introduction

Please find the quotation PDF attached to this email.

@component('mail::button', ['url' => ''])
View Quotation
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

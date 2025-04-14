@component('mail::message')
# Welcome {{ $companyName }}

Thank you for joining Digital Clean Solutions! We're excited to have you as part of our community.

@component('mail::button', ['url' => 'https://digitalcleansolution.com/', 'color' => 'green'])
Start Exploring
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

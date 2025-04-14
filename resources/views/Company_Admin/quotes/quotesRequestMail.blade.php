@component('mail::message')
# Introduction

Dear {{$supp_name}},
  Reply this email with Quotes on following product with quantity,

@component('mail::table')
| Product Name  | Quantity      |
| :------------- |:-------------:|
| {{$product_name}} | {{$quantity}} |

@endcomponent


Thanks,<br>
Reply To : {{ $from }}
{{ config('app.name') }}
@endcomponent

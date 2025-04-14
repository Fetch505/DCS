@extends('Super_Admin.layouts.admin')

@section('outer_css')
{!! Html::style('public/css/parsley.css') !!}
<style>
.dashboard-icon{ text-align:center;}
.dashboard-icon a{padding:80px 0; display:block; border:1px solid black; font-size:20px; margin:15px 0; -webkit-border-radius:6px; -moz-border-radius:6px; border-radius:6px; transition: transform .2s; /* Animation */}
.dashboard-icon a:hover{background:#EFEFEF; transform: scale(1.05);}
.dashboard-icon i{font-size:40px; display:block; padding-bottom:4px;}
.sliderOne{color:#ff4d4d;}
.sliderTwo{color:#00cc00;}
.sliderThree{color:#993399;}
.homeVideo{color:#993399;}
.houseownerVideo{color:#00b3b3;}
.tradesmanVideo{color:#737373;}
</style>
@endsection

@section('title', 'Dashboard')
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>

@section('content')
<section class="content">
  <div class="row">
    <h1 class="text-center">@lang('common.Workers Hourly Rate Management')</h1>

    <div class="col-md-12 row">
      <div class="col-md-4 dashboard-icon">
        <a href="{{route('socialInsurance.index')}}" class="sliderOne"><i class="glyphicon glyphicon-gift"></i>
          @lang('Company_Admin/dashboard.social_insurance')</a>
        </div>

        <div class="col-md-4 dashboard-icon">
          <a href="{{route('workableDaysCalculation.index')}}" class="sliderThree"><i class="glyphicon glyphicon-sunglasses"></i>
            @lang('Company_Admin/dashboard.workable_days')</a>
          </div>

          <div class="col-md-4 dashboard-icon">
            <a href="{{route('employeeGroup.index')}}" class="sliderTwo"><i class="glyphicon glyphicon-user"></i>
              @lang('Company_Admin/dashboard.employee_group')</a>
            </div>
          </div>
        </div>
      </section>
      @endsection

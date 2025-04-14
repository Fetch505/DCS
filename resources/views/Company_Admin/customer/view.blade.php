@extends('Company_Admin.layouts.main')
@section('title', 'Dashboard')
  <div id="wrapper">
    @section('content')
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('common.Customers Management')</h1>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
          <a class="btn btn-primary btn-md pull-right" href="{{route('customer.index')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Back')</a>
            <div class="panel panel-info">

                <div class="panel-heading">
                    @lang('common.Customer details')
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                  <div class="col-md-8 col-md-offset-4">
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Name'):</label>
                      <span style="position: absolute; left: 150px;">{{$customer->name}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Email'):</label>
                      <span style="position: absolute; left: 150px;">{{$customer->user->email}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.contact_person1'):</label>
                      <span style="position: absolute; left: 150px;">{{($customer->user->contact_person1)? $customer->user->contact_person1 : null}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.contact_person2'):</label>
                      <span style="position: absolute; left: 150px;">{{($customer->user->contact_person2)? $customer->user->contact_person2 : null}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Phone'):</label>
                      <span style="position: absolute; left: 150px;">{{$customer->user->phone}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Address'):</label>
                      <span style="position: absolute; left: 150px;">{{$customer->user->address}}</span>
                    </div>
                    <br>
                    <!-- <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Zip Code'):</label>
                      <span style="position: absolute; left: 150px;">{{$customer->user->zipcode}}</span>
                    </div>
                    <br> -->
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Country'):</label>
                      <span style="position: absolute; left: 150px;">{{$customer->user->country}}</span>
                    </div>
                    <br>
                    <!-- <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Mailbox'):</label>
                      <span style="position: absolute; left: 150px;">{{$customer->mailbox}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Mailbox') @lang('Company_Admin/dashboard.City'):</label>
                      <span style="position: absolute; left: 150px;">{{$customer->mailbox_city}}</span>
                    </div>
                    <br>
                    <div class="inline">
                      <label for="name">@lang('Company_Admin/dashboard.Mailbox') @lang('Company_Admin/dashboard.Zip Code'):</label>
                      <span style="position: absolute; left: 150px;">{{$customer->mailbox_zip}}</span>
                    </div> -->
                    <br>
                  </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    @endsection
  </div>



<!-- Content Header (Page header) -->

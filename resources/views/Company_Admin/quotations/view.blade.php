@extends('Company_Admin.layouts.main')

@section('title', 'Dashboard')

  <div id="wrapper">
    @section('content')
    <div class="row">
      <div class="col-sm-8">
        <h1>@lang('Company_Admin/dashboard.Quotation') @lang('Company_Admin/dashboard.Management')</h1>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
          <a class="btn btn-primary btn-md pull-right" href="{{route('quotations.index')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Back')</a>
          <a href="{{ route('quotations.send-pdf', $quotation->id) }}" class="btn btn-primary">Send PDF</a>
          </br>
          </br>
          
          <div class="panel panel-info">

            <div class="panel-heading">
              @lang('Company_Admin/dashboard.Quotation') @lang('Company_Admin/dashboard.Details')
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                
              <div class="form-group row">
                <label class="col-md-2" for="company_name">@lang('Company_Admin/dashboard.Company') @lang('Company_Admin/dashboard.Name'):*</label>
                <div class="col-md-4">
                  {{$quotation->company_name}}
                </div>

                <label class="col-md-2" for="poc">@lang('Company_Admin/dashboard.Point Of Contact')</label>
                <div class="col-md-4">
                  {{$quotation->poc}}
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-2" for="address">@lang('Company_Admin/dashboard.Address')</label>
                <div class="col-md-4">
                  {{$quotation->address}}
                </div>
                
                <label class="col-md-2" for="phone_number">@lang('Company_Admin/dashboard.Phone')</label>
                <div class="col-md-4">
                  {{$quotation->phone_number}}
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-2" for="rate_type">@lang('Company_Admin/dashboard.Rate') @lang('Company_Admin/dashboard.Type')</label>
                <div class="col-md-4">
                  {{$quotation->rate_type}}
                </div>
              </div>

              <table  width="100%" id="table" class="table table-bordered table-striped table-hover">
                  <thead>
                      <tr>
                          <th>@lang('Company_Admin/dashboard.Worker') @lang('Company_Admin/dashboard.Type')</th>
                          <th>@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Workers')</th>
                          @php
                              $rateType = $quotation->rate_type;
                          @endphp
                          @if($rateType === 'monthly')
                              <th>@lang('Company_Admin/dashboard.monthly_rate') €</th>
                          @elseif($rateType === 'hourly')
                              <th>@lang('Company_Admin/dashboard.hourly_rate') €</th>
                              <th>@lang('Company_Admin/dashboard.Total') @lang('Company_Admin/dashboard.Hours_per_worker')</th>
                          @endif
                          <th>% @lang('Company_Admin/dashboard.Discount')</th>
                          <th>@lang('Company_Admin/dashboard.Net') @lang('Company_Admin/dashboard.Rate') €</th>
                          <th>@lang('Company_Admin/dashboard.Price') €</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($quotation->items as $key => $item)
                      <tr>
                        <td>
                          {{$item->workerType->name}}
                        </td>
                        <td>
                          {{$item->total_workers}}
                        </td>
                        <td>
                          €{{$item->rate}}
                        </td>
                        @if($rateType === 'hourly')
                          <td>
                            €{{$item->total_hours_per_worker}}
                          </td>
                        @endif
                        <td>
                          {{$item->discount}}
                        </td>
                        <td>
                          €{{$item->net_rate}}
                        </td>
                        <td>
                          €{{ $item->price }}
                        </td>
                      </tr>
                    @endforeach
                    <tr>
                      @if($rateType === 'monthly')
                        <td colspan="5" class="text-right"><strong>Total:</strong></td>
                      @elseif($rateType === 'hourly')
                        <td colspan="6" class="text-right"><strong>Total:</strong></td>
                      @endif
                        <td>
                          €{{ $quotation->total_price }}
                        </td>
                    </tr>
                  </tbody>
              </table>



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

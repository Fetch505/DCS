<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    @include('Company_Admin.partials._header')
    <style media="screen">
    .dataTables_filter {
         float:right;
      }
    </style>
    @yield('outer_css')
  </head>
  <body>
    <div id="wrapper">

      <div> <div id="page-wrapper">
        @include('Company_Admin.partials._messages')
        <div class="row">
          <div class="col-md-3">
            <img src="{{ public_path('new_landing_page/img/final_logo_dcs.png') }}" alt="Logo" style="max-width: 150px;">
          </div>
        </div>

            <div class="panel panel-info">
              <div class="panel-heading">
                <h4>Sales Quotation</h4>
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <p><strong>Quote Number:</strong> {{ $quotation->id }}</p>
                <p><strong>Quote Date:</strong> {{ $quotation->created_at->format('m/d/Y') }}</p>
                  
                <div>
                  <p><strong>To:</strong></p>
                  <p>{{ $quotation->company_name }}</p>
                  <p>{{ $quotation->poc }}</p>
                  <p>{{ $quotation->address }}</p>
                  <p>Ph: {{ $quotation->phone_number }}</p>
                </div>

                <p><strong>Rate Type:</strong> {{$quotation->rate_type}}</p>

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
    </div>

    @include('Company_Admin.partials._script')
  </body>
</html>
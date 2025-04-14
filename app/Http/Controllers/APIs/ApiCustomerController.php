<?php

namespace App\Http\Controllers\APIs;

use App\Models\Customer;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiCustomerController extends Controller
{
    public function customerList()
    {
      return response()->json([
          'customerList' => CustomerResource::collection(Customer::all()),
      ]);
    }

    public function customerDetail($id)
    {
      return response()->json([
          'customerDetail' => new CustomerResource(Customer::where('id','=',$id)->first()),
      ]);
    }
}

<?php

namespace App\Http\Controllers\APIs;

use App\Models\Methods;
use App\Http\Resources\MethodResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiMethodController extends Controller
{
    public function methodsList()
    {
      return response()->json([
          'methodsList' => MethodResource::collection(Methods::all()),
      ]);
    }

    public function methodDetail($id)
    {
      return response()->json([
          'methodDetail' => new MethodResource(Methods::where('id','=',$id)->first()),
      ]);
    }
}

<?php

namespace App\Http\Controllers\APIs;

use App\Models\HealthAndSafety;
use App\Http\Resources\HealthResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiHealthController extends Controller
{
    public function List()
    {
      return response()->json([
          'HealthAndSafetyList' => HealthResource::collection(HealthAndSafety::all()),
      ]);
    }

    public function Detail($id)
    {
      return response()->json([
          'HealthAndSafety' => new HealthResource(HealthAndSafety::where('id','=',$id)->first()),
      ]);
    }
}

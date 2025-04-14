<?php

namespace App\Http\Controllers\CompanyAdmin;
use URL;
use DB;
use PDF;
use App;
use Hash;
use Auth;
use Lang;
use Session;
use Carbon\Carbon;
use App\Models\HealthAndSafety;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HealthAndSafetyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $healths = HealthAndSafety::all();
      return view('Company_Admin.health_and_safety.index')->withHealths($healths);
    }
  }
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
use App\Models\Methods;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $methods = Methods::all();
      return view('Company_Admin.methods.index')->withMethods($methods);
    }
  }
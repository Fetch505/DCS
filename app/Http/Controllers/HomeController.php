<?php

namespace App\Http\Controllers;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Auth;
use DB;
use App;
use Session;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if($request->user()->hasRole('superadmin')){
        return view('Super_Admin.dashboard');
      }

      else if($request->user()->hasRole('admin'))
      {
        $request->session()->put('locale', $request->user()->language);
        App::setLocale($request->user()->language);
        Session::get('locale');

        $id = $request->user()->id;
        $role_id = DB::table('roles')->where('name','user')->pluck('id')->first();

        $users = User::where('company_id','=',$id)
                ->where('role_id', $role_id)
                ->where('status','=',1)
                ->get();

        $assigned = 0;
        $loggedIn = 0;
        foreach ($users as $key => $user) {
          $projects_ids = [];
          foreach ($user->days as $key => $day) {
            if ($day->status == 1) {
              $projects_ids[] = $day->project_id;
            }
          }

          if (!empty($projects_ids)) {
            $assigned++;
          }

          if ($user->loggedIn) {
            $loggedIn++;
          }

        }

        $totalProjects = DB::table('projects')
                           ->where('company_id','=',$id)
                           ->count();

        $totalCustomers = DB::table('customers')
                            ->where('company_id','=',$id)
                            ->count();

        $totalWorkers = $users->count();
        $unassigned = $totalWorkers - $assigned;
        $loggedOut = $totalWorkers - $loggedIn;

        $totalReports = DB::table('inspections_review')
                           ->where('company_id','=',$id)
                           ->count();

        $totalExternalReports = DB::table('external_reports')
                           ->where('company_id','=',$id)
                           ->count();

        $totalMethods = DB::table('methods')
                          //  ->where('company_id','=',$id)
                           ->count();
        $totalSafety = DB::table('health_and_safety')->count();
                                             //  ->where('company_id','=',$id)


        return view('Company_Admin.dashboard')
            ->withTotalProjects($totalProjects)
            ->withTotalCustomers($totalCustomers)
            ->withTotalReports($totalReports)
            ->withTotalExternalReports($totalExternalReports)
            ->withTotalWorkers($totalWorkers)
            ->withTotalMethods($totalMethods)
            ->withTotalSafety($totalSafety)
            ->withAssigned($assigned)
            ->withUnassigned($unassigned)
            ->withLoggedIn($loggedIn)
            ->withLoggedOut($loggedOut);
      }

      else if($request->user()->hasRole('user'))
      {
        return view('User.dashboard');
      }

      else if($request->user()->hasRole('customer'))
      {
        return view('Customer.dashboard');
      }

        // return view('home');
    }
}

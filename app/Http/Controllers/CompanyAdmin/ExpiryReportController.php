<?php

namespace App\Http\Controllers\CompanyAdmin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Auth;
use DateTime; 


class ExpiryReportController extends Controller
{
    //

    public function index()
    {
        $company_id = Auth::user()->id;
        $worker=User::where('company_id',Auth::id())->where('name','!=',null)->where('role_id',3)->get();
        $project =DB::table('projects')->where('company_id',Auth::id())->get();
        $shifts =DB::table('shifts')->where('company_id',Auth::id())->get();
        $worker_report=[];
        $summary_report=[];
        $shift_count = DB::table('shifts')
            ->where('company_id','=',$company_id)
            ->count();
        return view('Company_Admin.worker_reports.expiry_report',compact('worker','project','worker_report','summary_report','shift_count','shifts'));
    }

    public function getWorkerOverTimeDetails(Request $request)
    {
        $companyId = '512';

        //dd("Im here");
        //dd($request->HolidayStartDate);
        $worker_report=[];
        $summary_report=[];

        // if ($request->worker_id == null && $request->project_id == null && $request->StartDate == null && $request->EndDate == null) {
        //     return redirect()->back()->with('message','The Field is required');
        // }            

    $worker_report = User::where('users.company_id', $companyId)
    ->join('days', 'users.id', '=', 'days.user_id')
    ->join('projects', 'days.project_id', '=', 'projects.id')
    ->where(function ($query) use ($request) {
        if ($request->worker_id !== null) {
            $query->where('user_id', $request->worker_id);
        }
        if ($request->project_id !== null) {
            $query->where('days.project_id', $request->project_id);
        }        
    })
    ->select(
        'users.employee_code',
        'users.name',
        'projects.name as Project',
        'users.visa_expiry_date',
        'users.passport_expiry_date',
        'users.health_card_expiry_date'
    )
    ->orderBy('users.employee_code', 'asc')
    ->distinct()
    ->get();
        
               

        $input = $request->all();
        //dd($worker_report);


        return redirect()->back()
            ->withInput($input)
            ->with([
                'worker_report'=>$worker_report,
                'summary_report'=>$summary_report]);
    }

}

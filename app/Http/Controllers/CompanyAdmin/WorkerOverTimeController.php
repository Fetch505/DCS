<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Auth;

class WorkerOverTimeController extends Controller
{
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
        return view('Company_Admin.worker_reports.over_time',compact('worker','project','worker_report','summary_report','shift_count','shifts'));
    }

    public function getWorkerOverTimeDetails(Request $request)
    {
        $worker_report=[];
        $summary_report=[];

        if ($request->worker_id == null && $request->project_id == null && $request->StartDate == null && $request->EndDate == null) {
            return redirect()->back()->with('message','The Field is required');
        }

        $worker_report = DB::table('users')
            //->join('worker_types', 'users.worker_type_id', '=', 'worker_types.id')
            ->join('days', 'users.id', '=', 'days.user_id')
            ->join('projects', 'projects.id', '=', 'days.project_id')
            ->join('tasks', 'tasks.id', '=', 'days.task_id')
            ->leftJoin('week_cards', 'week_cards.days_id', '=', 'days.id')
            ->leftJoin('time_cards', 'time_cards.week_cards_id', '=', 'week_cards.id')
            ->leftJoin('shifts', 'shifts.id', '=', 'users.shift_id')
            ->join('locations', 'locations.project_id', '=', 'projects.id')
            ->leftJoin(DB::raw('(SELECT id, name FROM worker_types) AS worker_types'), 'users.worker_type_id', '=', 'worker_types.id')
            ->where(function ($query) use ($request) {
                if ($request->worker_id !== null) {
                    $query->where('user_id', $request->worker_id);
                }
                if ($request->project_id !== null) {
                    $query->where('days.project_id', $request->project_id);
                }
                if ($request->shift_id !== null) {
                    $query->where('shifts.id', $request->shift_id);
                }
                if ($request->StartDate !== null) {
                    $query->whereDate('time_cards.created_at', '>=', $request->StartDate);
                }
                if ($request->EndDate !== null) {
                    $query->whereDate('time_cards.created_at', '<=', $request->EndDate);
                }
            })
            ->select('users.employee_code as employee_code','users.name as worker_name', 'worker_types.name as designation','days.project_id', 'locations.name as location_name', 'tasks.name as tasks_name', 'projects.country as country','projects.name as project_name', 'projects.code as receiving_order', 'projects.break as project_break', 'time_cards.created_at', 'time_cards.day_name','time_cards.check_in_time', 'time_cards.check_out_time', 'time_cards.total_time as total_time','shifts.total_time as shift_total_time' ,'shifts.title as shift_title')
            ->orderByDesc('time_cards.created_at')
            ->get();

        foreach($worker_report as $key => $report){

            $country = $report->country;
            $created = $report->created_at;
            $check_in = $report->check_in_time;
            $check_out = $report->check_out_time;

            $out = Carbon::parse($check_out);
            $in = Carbon::parse($check_in);

            $carbonTime = Carbon::parse($created);
            $date = $carbonTime->toDateString();

            $countryTimezones = Config::get('countryTimezones');


            if ($country && isset($countryTimezones[$country])) {
                $timezonecountry = $countryTimezones[$country];

                if(!is_null($created)){
                    $report->created_at = Carbon::createFromFormat('Y-m-d H:i:s', $created, config('app.timezone'))
                        ->setTimezone($timezonecountry)
                        ->format('Y-m-d H:i:s');
                }

                if(!is_null($check_in)){
                    $check_in = $date . ' ' . $check_in;
                    $report->check_in_time = Carbon::createFromFormat('Y-m-d H:i:s', $check_in, config('app.timezone'))
                        ->setTimezone($timezonecountry)
                        ->format('H:i:s');
                }

                if(!is_null($check_out)){
                    $check_out = $date . ' ' . $check_out;
                    $report->check_out_time = Carbon::createFromFormat('Y-m-d H:i:s', $check_out, config('app.timezone'))
                        ->setTimezone($timezonecountry)
                        ->format('H:i:s');
                }

                if(!is_null($check_out) && !is_null($check_in)) {
                    
                    $diff = $out->diff($in);
                    
                    // $totalHours = $diff->h + ($diff->days * 24);

                    $totalHours = (float)$report->total_time;
                    
                    $report->over_time = $totalHours - $report->shift_total_time;

                    $report->check_in = $check_in;

                    $report->check_out = $check_out;

                    $report->total_hours = $totalHours;



                // Subtract break hours from overtime
                $breakMinutes = $report->project_break;

                //dd($breakHours);
                if (!is_null($breakMinutes)) {

                    $breakHours = $breakMinutes / 60;
                    $report->over_time -= $breakHours;                   

                    

                    //dd($report->total_hours);
                }

                if ($report->day_name === 'Fri') {
                    $report->over_time += 8;
                }

                $report->over_time = max(0, $report->over_time); // Ensure overtime is non-negative
                
                }else {
                    $report->over_time = 0;
                }
            }
        }

        $input = $request->all();
        
        //dd($worker_report);


        return redirect()->back()
            ->withInput($input)
            ->with([
                'worker_report'=>$worker_report,
                'summary_report'=>$summary_report]);
    }
}

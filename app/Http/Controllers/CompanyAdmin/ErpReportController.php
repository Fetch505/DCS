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

class ErpReportController extends Controller
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
        return view('Company_Admin.worker_reports.erp_report',compact('worker','project','worker_report','summary_report','shift_count','shifts'));
    }

    public function getWorkerOverTimeDetails(Request $request)
    {
        //dd($request->HolidayStartDate);
        $worker_report=[];
        $summary_report=[];

        if ($request->worker_id == null && $request->project_id == null && $request->StartDate == null && $request->EndDate == null) {
            return redirect()->back()->with('message','The Field is required');
        }            

    $normalHoursQuery = DB::table('users')
    ->select(
        'users.employee_code as employee_code',
        'users.name as worker_name',
        'worker_types.name as designation',
        'time_cards.created_at as input_date',
        DB::raw("'0800' as attendance"),
        'shifts.total_time as hours',
        DB::raw('ROUND(TIME_TO_SEC(time_cards.total_time) / 3600) as total_shift_hours'),        
        'projects.break as break_time',
        'projects.code as project_code'
    )
    ->leftJoin('worker_types', 'users.worker_type_id', '=', 'worker_types.id')
    ->leftJoin('days', 'days.user_id', '=', 'users.id')
    ->leftJoin('tasks', 'tasks.id', '=', 'days.task_id')
    ->leftJoin('projects', 'projects.id', '=', 'days.project_id')
    ->leftJoin('week_cards', 'week_cards.days_id', '=', 'days.id')
    ->leftJoin('time_cards', 'time_cards.week_cards_id', '=', 'week_cards.id')
    ->leftJoin('shifts', 'shifts.id', '=', 'users.shift_id')
    ->where('time_cards.day_name', '!=', 'Fri')
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
                if ($request->HolidayStartDate !== null && $request->HolidayEndDate !== null) {
                    $query->where(function ($query) use ($request) {
                    $query->whereNotBetween(DB::raw('DATE(time_cards.created_at)'), [$request->HolidayStartDate, $request->HolidayEndDate]);
                    });
                }         
                
                
            })                   
            ->orderByDesc('users.name')
            ->get();
        
               

    $overtimeHoursQuery = DB::table('users')
    ->select(
        'users.employee_code as employee_code',
        'users.name as worker_name',
        'worker_types.name as designation',
        'time_cards.created_at as input_date',
        'time_cards.day_name as day', // Include the 'day' column
        DB::raw("'0801' as attendance"),
        //DB::raw('CAST((ROUND(TIME_TO_SEC(time_cards.total_time) / 3600, 1) - shifts.total_time) - projects.break/60 AS DECIMAL(5,2)) as hours'),
        //DB::raw('CAST(ROUND((TIME_TO_SEC(time_cards.total_time) / 3600 - shifts.total_time - projects.break / 60) * 4) / 4 AS DECIMAL(5, 2)) as hours'),
        DB::raw('CASE 
        WHEN projects.break = 30 THEN 
        GREATEST(ROUND(LEAST((FLOOR(TIME_TO_SEC(time_cards.total_time) / 900) / 4.0 - shifts.total_time), 3.5), 2), 0)
        ELSE 
        GREATEST(ROUND(LEAST((FLOOR(TIME_TO_SEC(time_cards.total_time) / 900) / 4.0 - shifts.total_time), 3), 2), 0)
        END as hours'
        ),
        'shifts.total_time as total_shift_hours',
        'projects.break as break_time',
        'projects.code as project_code'
    )
    ->leftJoin('worker_types', 'users.worker_type_id', '=', 'worker_types.id')
    ->leftJoin('days', 'days.user_id', '=', 'users.id')
    ->leftJoin('tasks', 'tasks.id', '=', 'days.task_id')
    ->leftJoin('projects', 'projects.id', '=', 'days.project_id')
    ->leftJoin('week_cards', 'week_cards.days_id', '=', 'days.id')
    ->leftJoin('time_cards', 'time_cards.week_cards_id', '=', 'week_cards.id')
    ->leftJoin('shifts', 'shifts.id', '=', 'users.shift_id')
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
    ->orderByDesc('users.name')    
    ->get();


    // Modify the 'hours' column for records where the day is Friday
    $overtimeHoursQuery->each(function ($record) {
    if ($record->day === 'Fri') {
        $record->hours += 8; // Add 8 hours to overtime
    }
    });

    

    $worker_report = $normalHoursQuery->concat($overtimeHoursQuery);
    
    if($request->HolidayStartDate !== null){
        
        $holiday_start = $request->HolidayStartDate; // Replace with user input
        $holiday_end = $request->HolidayEndDate;   // Replace with user input


        $date_list = [];
        $holiday_start_date = new DateTime($holiday_start);
        $holiday_end_date = new DateTime($holiday_end);

        while ($holiday_start_date <= $holiday_end_date) {
        $date_list[] = $holiday_start_date->format('Y-m-d');
        $holiday_start_date->modify('+1 day');
        
        }

        foreach ($date_list as $holiday_date) {
            $worker_report->each(function ($record) use ($holiday_date) {
                // Add 8 hours for the holiday date
                $record_date = date('Y-m-d', strtotime($record->input_date));
                if ($record_date === $holiday_date) {
                    $record->hours += 8;
                }
            });
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

<?php

namespace App\Http\Controllers\Workers;

use DB;
use Auth;
use DateTime;
use App\Models\Day;
use App\Models\WeekCard;
use App\Models\TimeCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkerController extends Controller
{
    public function index(){
        $id = Auth::user()->id;
        $dayCards = Day::where('user_id','=',$id)
                    ->orderBy('created_at','DESC')
                    ->get();
        // dd($dayCards[0]->job->project->name);
        return view('User.index')->withDayCards($dayCards);
    }


    public function workerDetails(){
        $id = Auth::user()->id;
        $day = date('D');
        $column = strtolower($day);
        $day_cond = "days.wed,'=',1";
// dd($day_cond);
        $dailyJobs = DB::table('days')
                     ->join('project_jobs', 'project_jobs.id', '=', 'days.job_id')
                     ->join('projects', 'projects.id', '=', 'project_jobs.project_id')
                     ->join('tasks', 'tasks.id', '=', 'days.task_id')
                     ->join('users', 'users.id', '=', 'projects.customer_id')
                     ->join('floors', 'floors.id', '=', 'project_jobs.floor_id')
                     ->where('days.user_id','=',$id)
                     ->where('days.type','=','daily')
                     ->where('days.'.$column.'','=','1')
                     ->orderBy('days.created_at','DESC')
                     ->select('days.*','projects.name as project_name','projects.address as project_address','tasks.name as task_name','users.name as customer_name','floors.name as floor_name')
                     ->get();

        $weeklyJobs = DB::table('days')
                     ->join('project_jobs', 'project_jobs.id', '=', 'days.job_id')
                     ->join('projects', 'projects.id', '=', 'project_jobs.project_id')
                     ->join('tasks', 'tasks.id', '=', 'days.task_id')
                     ->join('users', 'users.id', '=', 'projects.customer_id')
                     ->join('floors', 'floors.id', '=', 'project_jobs.floor_id')
                     ->where('days.user_id','=',$id)
                     ->where('days.type','=','weekly')
                     ->where('days.'.$column.'','=','1')
                     ->orderBy('days.created_at','DESC')
                     ->select('days.*','projects.name as project_name','projects.address as project_address','tasks.name as task_name','users.name as customer_name','floors.name as floor_name')
                     ->get();

        return response()->json([
            'dailyJobs' => $dailyJobs,
            'weeklyJobs' => $weeklyJobs
        ],200);
    }

    public function startJob($id){
        $year = date('Y');
        $week = date('W');
        $day = date('D');
        $check_in_time = date('H:i');
        // check whether entry of this weeknumber exist or note
        $week_card = WeekCard::where('weeknumber','=',$year.$week)
                ->where('days_id','=',$id)
                ->first();

        if (isset($week_card->weeknumber)) {
            // no need to make new row for this weeknumber, use already created row
            $timeCard = new TimeCard;
            $timeCard->week_cards_id = $week_card->id;
            $timeCard->day_name = $day;
            $timeCard->check_in_time = $check_in_time;
            $timeCard->job_status_id = 2;// started
            $timeCard->save();
        }else{
            //create new row for weeknumber
            $weekCard = new WeekCard;
            $weekCard->weeknumber = $year.$week;
            $weekCard->days_id = $id;
            $weekCard->save();

            $timeCard = new TimeCard;
            $timeCard->week_cards_id = $weekCard->id;
            $timeCard->day_name = $day;
            $timeCard->check_in_time = $check_in_time;
            $timeCard->job_status_id = 2;// started
            $timeCard->save();
        }

        return response()->json([
            'message'=>'success',
            'status'=>1
        ],200);
    }//start job ends here

    private function calculateTime($timeCard){
        $startTime = $timeCard->check_in_time;
        $endTime = $timeCard->check_out_time;
        $startTime = new DateTime($startTime);
        $endTime = new DateTime($endTime);
        $difference = $startTime->diff($endTime);
        $total_time = $difference->h.':'.$difference->i;
        return $total_time;
    }//calculateTime ends here

    private function totalWeekTime($time_per_week, $total_time){

        $weekly_time = explode(":",$time_per_week);
        $today_time = explode(":",$total_time);
        $total_hours= (int)$weekly_time[0] + (int)$today_time[0];
        $total_mins= (int)$weekly_time[1] + (int)$today_time[1];
        if($total_mins>60){
            $remain_mins = $total_mins % 60;
            $remain_hours = $total_mins / 60;
            $total_mins= $total_mins+$remain_mins;
            $total_hours= $total_hours+$remain_hours;
        }

        return $total_hours.':'.$total_mins;
    }// totalWeekTime ends here

    public function endJob($id){
        $year = date('Y');
        $week = date('W');
        $day = date('D');
        $check_out_time = date('H:i');
        $weeknumber = $year.$week;

        $weekCard = WeekCard::where('weeknumber','=',$weeknumber)
                            ->where('days_id','=',$id)
                            ->first();

        $timeCard =             TimeCard::where('week_cards_id','=',$weekCard->id)
                    ->where('day_name','=',$day)
                    ->first();

        $timeCard->check_out_time = $check_out_time;
        $timeCard->job_status_id = 3;// Finished
        $total_time = $this->calculateTime($timeCard);
        $timeCard->total_time = $total_time;
        $timeCard->save();

        //now update weekcard columns
        $column = strtolower($day); //will return mon, or ..,sun
        $weekCard->$column = $total_time;
        $time_per_week = $weekCard->total_hours_per_week;
        $new_time = $this->totalWeekTime($time_per_week,$total_time);
        $weekCard->total_hours_per_week = $new_time;
        $weekCard->save();
        //
        // dd($new_time);
        //
        // dd($time_arr_today);
        return response()->json([
            'message'=>'success',
            'status'=>1
        ],200);
    }//endJob ends here


    public function checkJobStatus($id){
        $year = date('Y');
        $week = date('W');
        $day = date('D');
        $status = 1;
        $start_time = '';
        $end_time = '';
        $total_time = '';

        $check_out_time = date('H:i');
        $weeknumber = $year.$week;

        $weekCard = WeekCard::where('weeknumber','=',$weeknumber)
                            ->where('days_id','=',$id)
                            ->first();

        if (isset($weekCard->id)) {
            $timeCard =    TimeCard::where('week_cards_id','=',$weekCard->id)
                    ->where('day_name','=',$day)
                    ->first();
            if (isset($timeCard->job_status_id)) {
                $status = $timeCard->job_status_id;
                $start_time = $timeCard->check_in_time;
                $end_time = $timeCard->check_out_time;
                $total_time = $timeCard->total_time;
            }
        }//is weekcard is set for this job
        else{
          $status = 1;
          $start_time = '';
          $end_time = '';
          $total_time = '';
        }

        return response()->json([
            'status'=>$status,
            'start_time'=>$start_time,
            'end_time'=>$end_time,
            'total_time'=>$total_time,
        ],200);

    }//checkJobStatus ends here

    public function myJobs(){
        return view('User.my_jobs');
    }//workerAllJobs ends here

    public function workerAllJobs(){
        $id = Auth::user()->id;
        $dailyJobs = DB::table('days')
                     ->join('project_jobs', 'project_jobs.id', '=', 'days.job_id')
                     ->join('projects', 'projects.id', '=', 'project_jobs.project_id')
                     ->join('tasks', 'tasks.id', '=', 'days.task_id')
                     ->join('users', 'users.id', '=', 'projects.customer_id')
                     ->join('floors', 'floors.id', '=', 'project_jobs.floor_id')
                     ->where('days.user_id','=',$id)
                     ->where('days.type','=','daily')
                     ->orderBy('days.created_at','DESC')
                     ->select('days.*','projects.name as project_name','projects.address as project_address','tasks.name as task_name','users.name as customer_name','floors.name as floor_name')
                     ->get();

        $weeklyJobs = DB::table('days')
                     ->join('project_jobs', 'project_jobs.id', '=', 'days.job_id')
                     ->join('projects', 'projects.id', '=', 'project_jobs.project_id')
                     ->join('tasks', 'tasks.id', '=', 'days.task_id')
                     ->join('users', 'users.id', '=', 'projects.customer_id')
                     ->join('floors', 'floors.id', '=', 'project_jobs.floor_id')
                     ->where('days.user_id','=',$id)
                     ->where('days.type','=','weekly')
                     ->orderBy('days.created_at','DESC')
                     ->select('days.*','projects.name as project_name','projects.address as project_address','tasks.name as task_name','users.name as customer_name','floors.name as floor_name')
                     ->get();

                     return response()->json([
                         'dailyJobs' => $dailyJobs,
                         'weeklyJobs' => $weeklyJobs
                     ],200);
    }//workerAllJobs ends here

    public function getWeekCards($id){
        $timeCards = Day::find($id);
        $weekCards = WeekCard::where('days_id','=',$id)->get();

        return response()->json([
            'week_cards'=>$weekCards,
            'time_cards'=>$timeCards,
            'status' => 1
        ],200);
    }//getWeekCards ends here
}

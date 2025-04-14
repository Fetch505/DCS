<?php

namespace App\Http\Controllers\APIs;
use DB;
use Auth;
use App\Models\Day;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Resources\ProjectResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ApiProjectController extends Controller
{
    public function projectsList(Request $request)
    {
    //different project lists for different roles user(worker),manager, supervisor
      $header = $request->header('language');
      $user_id = Auth::user()->id;
      $role = strtolower(Auth::user()->role->name);
      if ($role == 'user') {
          $project_ids = Day::where('user_id','=',$user_id)->pluck('project_id');
          $projectsList = ProjectResource::collection(Project::whereIn('id',$project_ids)->get());
      }else if ($role == 'supervisor') {
        if(Auth::user()->isInspector()){
          $projectsList = ProjectResource::collection(Project::where('inspector_id','=',$user_id)->get());
        }else {
          $projectsList = ProjectResource::collection(Project::where('supervisor_id','=',$user_id)->get());
        }

      }else if ($role == 'manager') {
          $supervisor_ids = User::where('reports_to_id','=',$user_id)->pluck('id');
          $projectsList =ProjectResource::collection(Project::whereIn('supervisor_id',$supervisor_ids)->get());
      }else {
          $projectsList = false;
      }

      if ($projectsList) {
        $message = ($header == 'en') ? 'Login Worker Project Found.' : 'Login Worker Project gevonden.' ;
        }else {
        $message = ($header == 'en') ? 'No Login Worker Project Found.' : 'Geen Login Worker-project gevonden.' ;
        }

      return response()->json([
          'role' => $role,
          'status' => ($projectsList) ? true : false,
          'message' => $message,
          'projectsList' => $projectsList,
      ]);
    }

    public function myTodayTasks(Request $request,$project_id,$location_id)
    {
      $header = $request->header('language');
      $countryTimezones = Config::get('countryTimezones');

      $user_id = Auth::user()->id;
      $company_id  = DB::table('users')
                  ->where('id','=',$user_id)
                  ->value('company_id');

      $shift_count = DB::table('shifts')
                ->where('company_id','=',$company_id)
                ->count();

      $day_name = strtolower(date('D')); // mon, tue, wed
      $year = date('Y');
      $week = date('W');
      $day = date('D');
        
      if($shift_count>0){
        $shift_id  = DB::table('users')
                  ->where('id','=',$user_id)
                  ->value('shift_id');

        $country = DB::table('projects')
                  ->where('id','=',$project_id)
                  ->value('country');
        
        $server_time = Carbon::now()->format('H:i:s');
        $current_time = Carbon::now()->format('H:i:s');
        if ($country && isset($countryTimezones[$country])) {
            $timezone = $countryTimezones[$country];
            $current_time = Carbon::now($timezone)->format('H:i:s');
        }
        $time_starts  = DB::table('shifts')
                  ->where('id','=',$shift_id)
                  ->value('time_starts');

        $time_ends  = DB::table('shifts')
                  ->where('id','=',$shift_id)
                  ->value('time_ends');

        $time_ends = strtotime($time_ends)  + 3600;
        $time_ends = date('H:i:s', $time_ends);

        // $time_starts  = '12:00:00'; 
        // $server_time  = '22:00:00'; 
        // $current_time = '00:00:00'; 
        // $time_ends    = '01:00:00';
        
        
        // $time_starts  = '18:00:00'; 
        // $server_time  = '22:00:00'; 
        // $current_time = '00:00:00'; 
        // $time_ends    = '01:00:00'; 

        if ($time_starts > $time_ends) {
          if (strtotime($current_time) >= strtotime('00:00:00') && strtotime($server_time) < strtotime($time_ends)) {
              $day_name = strtolower(date('D', strtotime('-1 day')));
              $year = date('Y', strtotime('-1 day'));
              $week = date('W', strtotime('-1 day'));
              $day = date('D', strtotime('-1 day'));
          } 
        }
      }          

      $allJobs = Day::where('user_id','=',$user_id)
                    ->where('project_id','=',$project_id)
                    ->where('location_id','=',$location_id)
                    ->where($day_name,'=',1)
                    ->where('status','=',1)
                    ->pluck('id')->toArray();

      $completedJobs = DB::table('days')
            ->join('tasks', 'tasks.id', '=', 'days.task_id')
            ->join('week_cards', 'days.id', '=', 'week_cards.days_id')
            ->join('time_cards', 'week_cards.id', '=', 'time_cards.week_cards_id')
            ->where('days.user_id','=',$user_id)
            ->where('days.project_id','=',$project_id)
            ->where('days.status','=',1)
            ->where("days.".$day_name,'=',1)
            ->where('week_cards.weeknumber','=',$year.$week)
            ->where('time_cards.day_name','=',$day)
            ->where('time_cards.job_status_id','=',3)
            ->whereNotNull('time_cards.total_time')
            ->select('days.id')
            ->get();

// ->select('tasks.id as task_id','tasks.name as task_name','days.*')
       $completedJobs = Arr::pluck($completedJobs, 'id');

       $result = array_diff($allJobs,$completedJobs);
       // $tasks = Day::whereIn('id',$result)->get();
       $tasks =  DB::table('days')
       ->join('tasks', 'tasks.id', '=', 'days.task_id')
       ->join('projects', 'projects.id', '=', 'days.project_id')
       ->join('areas', 'areas.id', '=', 'days.area_id')
       ->join('project_jobs', 'project_jobs.id', '=', 'days.job_id')
       ->join('floors', 'floors.id', '=', 'project_jobs.floor_id')
       ->whereIn('days.id',$result)
       ->select('tasks.name as task_name','projects.name as project_name','areas.name as area_name','floors.name as floor_name','days.*')
       ->get();

       DB::connection()->enableQueryLog();

       $startedJobs = DB::table('days')
          ->join('tasks', 'tasks.id', '=', 'days.task_id')
          ->join('week_cards', 'days.id', '=', 'week_cards.days_id')
          ->join('time_cards', 'week_cards.id', '=', 'time_cards.week_cards_id')
          ->where('days.user_id','=',$user_id)
          ->where('days.project_id','=',$project_id)
          ->where('days.status','=',1)
          ->where("days.".$day_name,'=',1)
          ->where('week_cards.weeknumber','=',$year.$week)
          ->where('time_cards.day_name','=',$day)
          ->where('time_cards.job_status_id','=',2)
          ->whereNull('time_cards.total_time')
          ->select('days.id')
          ->get();
        
        //$queries = DB::getQueryLog();
        //$last_query = end($queries);

        $startedJobs = Arr::pluck($startedJobs, 'id');

        foreach ($tasks as $task) {
          $task->isStarted = false;

          if(in_array($task->id,$startedJobs)){
            $task->isStarted = true;
          }
        }

        $message = "";


        if (!$tasks->isEmpty()) {
          $message = ($header == 'en') ? 'Login Worker Today Tasks Found.' : 'Login Worker Vandaag Taken gevonden.' ;
        }else {
          $message = ($header == 'en') ? 'No Login Worker Today Tasks Found.' : 'Geen login-medewerker vandaag Taken gevonden.' ;
        }

      // $user                           = Auth::user();

      // if($user->shift_id && $user->shift_id == 6 ) {

      //   Log::channel('daily')->info('Current Time (Kuwait Time): ' . $current_time);
      //   Log::channel('daily')->info('Server Time: ' . $server_time);
      //   Log::channel('daily')->info('Adjusted Day Name: ' . $day_name);
      //   Log::channel('daily')->info('Adjusted Year: ' . $year);
      //   Log::channel('daily')->info('Adjusted Week: ' . $week);
      //   Log::channel('daily')->info('Adjusted Day: ' . $day);

      //   $user_details                   = new \stdClass();
      //   $user_details->user_id          = $user->id;
      //   $user_details->username         = $user->name;
      //   $user_details->shift_id         = $user->shift_id;
      //   $user_details->shift_title      = $user->shift->title;
      //   $user_details->shift_id         = $user->shift_id;
      //   $user_details->message          = $message;
      //   $user_details->started_jobs_id  = $startedJobs;
      //   $user_details->time_starts      = $time_starts;
      //   $user_details->time_ends        = $time_ends;
  
      //   Log::channel('daily')->info("User Details: \n");
      //   Log::channel('daily')->info(print_r($user_details, true));
      //   Log::channel('daily')->info("\n");
      //   Log::channel('daily')->info(print_r($last_query, true));
      //   Log::channel('daily')->info("-------------------------------------------------");
      //   Log::channel('daily')->info("-------------------------------------------------");
      //   Log::channel('daily')->info("------------------------------------------------- \n");

      // }


      return response()->json([
          'status' => ($tasks) ? true : false,
          'message' => $message,
          'todayJobs' => $result,
          'startedJobs' => $startedJobs,
          'tasks' => $tasks,
      ]);
    }

    public function projectDetail($id)
    {
      return response()->json([
          'projectDetail' => new ProjectResource(Project::find($id)),
      ]);
    }

    public function projectWorkers(Request $request, $id, $location_id)
    {
      $header = $request->header('language');
      $worker_ids = Day::where('project_id','=',$id)
                ->where('location_id','=',$location_id)
                ->pluck('user_id');
      
      
      $workers = User::whereIn('id',$worker_ids)->paginate(5);      

      $message = ($header == 'en') ? 'List of Workers under selected project' : 'Lijst met werknemers onder het geselecteerde project' ;

      return response()->json([
        'status' => true,
        'message' => $message,
        'startedJobs' => $startedJobs,
        'worker_ids' => $worker_ids,
      ]);
    }
}

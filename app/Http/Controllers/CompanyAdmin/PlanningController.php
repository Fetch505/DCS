<?php

namespace App\Http\Controllers\CompanyAdmin;
use Auth;
use DB;
use App;
use App\Models\Project;
use App\Models\Job;
use App\Models\User;
use App\Models\Day;
use App\Models\Floor;
use App\Models\Area;
use App\Models\Element;
use App\Models\Task;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Notification;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class PlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers=[];
        $areas     = Area::where('company_id', '=', Auth::id())->select('name','id')->orderBy('name', 'asc')->get();
        $floors    = Floor::where('company_id', '=', Auth::id())->select('name','id')->orderBy('name', 'asc')->get();
        $elements  = Element::where('company_id', '=', Auth::id())->select('name','id')->orderBy('name', 'asc')->get();
        $projects  =DB::table('projects')->where('company_id',Auth::id())->get();

        $jobData = [
            'projects' => $projects,
            'areas' => $areas,
            'floors' => $floors,
            'elements' => $elements,
        ];

        return view('Company_Admin.planning.index',compact('jobData','workers','projects'));
    }

    public function multipleNotifications($title, $body,$tokens,$reciverId,$senderId)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
                                    ->setSound('default');

        /// Payload data ///
        $my_data = [
            'title' => $title,
            'body' => $body,
            'NotificationReceiversIds' => $reciverId,
            'NotificationSenderId' => $senderId,
        ];
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => $my_data]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

        // return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();

        // return Array (key : oldToken, value : new token - you must change the token in your database)
        $downstreamResponse->tokensToModify();

        // return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();

        // return Array (key:token, value:error) - in production you should remove from your database the tokens present in this array
        $downstreamResponse->tokensWithError();
        return $my_data;
    }

    public function assignWorkers(Request $request)
    {
        $locale = App::getLocale();
        $workers = $request->selectedWorkers;
        $newJob = $request->newJob;

        $Job = Job::where('project_id', '=', $newJob['project_id'])->where('floor_id', '=', $newJob['floor_id'])->first();
        $location = Location::where('project_id','=',$newJob['project_id'])->first();

        if(!$Job) {
            $Job = new Job;
            $Job->project_id = $newJob['project_id'];
            $Job->floor_id   = $newJob['floor_id'];
            $Job->save();
        }

        foreach($workers as $key => $worker){
            DB::table('days')
                ->where('id', $worker['day_id'])
                ->update(['status' => 0]);

            $day = Day::where([
                'job_id'        => $Job->id,
                'task_id'       => $newJob['task_id'],
                'element_id'    => $newJob['element_id'],
                'user_id'       => $worker['worker_id'],
                'area_id'       => $newJob['area_id'],
                'location_id'   => $location->id,
                'project_id'    => $newJob['project_id'],
            ])->first();

            if ($day) {
                $day->status    = 1;
            }
            else{
                $day                = new Day;
                $day->job_id        = $Job->id;
                $day->task_id       = $newJob['task_id'];
                $day->element_id    = $newJob['element_id'];
                $day->user_id       = $worker['worker_id'];
                $day->area_id       = $newJob['area_id'];
                $day->location_id   = $location->id;
                $day->project_id    = $newJob['project_id'];
            }

            if ($locale == 'en') {
                $day->type      = strtolower($newJob['type']);
            } else {
                $day->type      = $newJob['type'] == 'Dagelijks' ? 'daily' : 'weekly';
            }

            if ($newJob['type'] == 'Daily' || $newJob['type'] == 'Dagelijks') {
                $day->mon       = $newJob['mon'] ? 1 : 0;
                $day->tue       = $newJob['tue'] ? 1 : 0;
                $day->wed       = $newJob['wed'] ? 1 : 0;
                $day->thu       = $newJob['thu'] ? 1 : 0;
                $day->fri       = $newJob['fri'] ? 1 : 0;
                $day->sat       = $newJob['sat'] ? 1 : 0;
                $day->sun       = $newJob['sun'] ? 1 : 0;
                $day->week_number   = null;
            } else {
                $day->mon      = 0;
                $day->tue      = 0;
                $day->wed      = 0;
                $day->thu      = 0;
                $day->fri      = 0;
                $day->sat      = 0;
                $day->sun      = 0;
                $day->week_number   =  json_encode($newJob['week_number']);
            }
            $day->save();

            $receiverId[] = $worker['worker_id']; 
        }

        $tokens = User::whereIn('id',$receiverId)
                  ->pluck('fcm_token')->toArray();
        $senderId = Auth::user()->id;

        if ($locale == 'en') {
            $title = "Project Changed";
            $body = 'You have been assigned to the '. $location->project->name .' project at the location '. $location->name;
        }else{
            $title = "Project Gewijzigd";
            $body = 'U bent toegewezen aan het project '. $location->project->name .' op de locatie '. $location->name;
        }

        $payLoadData= $this->multipleNotifications($title, $body, $tokens, $receiverId, $senderId);

        foreach ($receiverId as $id) {
            $notification = new Notification;
            $notification->title = $title;
            $notification->body  = $body;
            $notification->remarks  =$title;
            $notification->status  = 0;
            $notification->reciever_id = $id;
            $notification->sender_id = $senderId;
            $notification->created_at = Carbon::now()->setTimezone('Europe/Amsterdam');
            $notification->save();
         }

        return response()->json([
            'message' => 'success',
            'status'  => 1
          ]);
    }

    public function unassignWorkers(Request $request)
    {
        $workers = $request->selectedWorkers;
        foreach($workers as $key => $worker){
            DB::table('days')
                ->where('id', $worker['day_id'])
                ->update(['status' => 0]);
        }
        return response()->json([
            'message' => 'success',
            'status'  => 1
          ]);
    }

    public function getProjectWorkers(Request $request)
    {
        $role_id = DB::table('roles')->where('name','user')->pluck('id')->first();
            
        $baseQuery = DB::table('projects')
            ->join('days', function ($join) {
                $join->on('projects.id', '=', 'days.project_id')
                        ->where('days.status', 1);
            })
            ->join('tasks', 'tasks.id', '=', 'days.task_id')
            ->rightJoin('users', 'users.id', '=', 'days.user_id')
            ->leftJoin('leave_user', function ($join) {
                $join->on('users.id', '=', 'leave_user.user_id')
                        ->join('leaves', 'leaves.id', '=', 'leave_user.leave_id')
                        ->where('leaves.status_id', 2)
                        ->where('leaves.leave_type_id', 2)
                        ->where(DB::raw("STR_TO_DATE(leaves.end_date, '%d/%m/%Y')"), '>', Carbon::now());
            })
            ->where('users.company_id', Auth::id())
            ->where('users.status', 1)
            ->where('users.role_id', $role_id)
            ->select(
                'users.id as worker_id',
                'users.name as worker_name',
                'users.employee_code as employee_code',
                'users.resign_date as resign_date',
                'projects.id as project_id',
                'projects.name as project_name',
                'days.id as day_id',
                'days.type as day_type',
                'tasks.id as task_id',
                'tasks.name as tasks_name',
                'leaves.leave_type_id as leave_type_id',
                'leaves.details as leave_details',                
                'leaves.start_date',
                'leaves.end_date'
            );

        if ($request->project_id == '0') {
            $workers = $baseQuery->whereNull('days.user_id')->get();
        } else{
            $workers = $baseQuery->where('days.project_id', $request->project_id)->get();
        }
        
        $input = $request->all();
    
        return redirect()->back()
        ->withInput($input)
        ->with([
            'workers'=>$workers]);
    }

}
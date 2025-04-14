<?php

namespace App\Http\Controllers\APIs;

use DB;
use Auth;
use Carbon\Carbon;
use DateTime;
use DateInterval;
use App\Models\WeekCard;
use App\Models\TimeCard;
use App\Models\User;
use App\Models\Job;
use App\Models\Day;
use App\Models\Project;
use App\Models\Notification;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Http\Resources\DayResource;
use App\Http\Resources\JobResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class ApiJobsController extends Controller
{
   public function singleNotification($title, $body,    $token,$reciverId,$senderId)
    {
      $optionBuilder = new OptionsBuilder();
      $optionBuilder->setTimeToLive(60*20);

      $notificationBuilder = new PayloadNotificationBuilder($title);
      $notificationBuilder->setBody($body)
                  ->setSound('default');

      //Payload data ///
      $my_data = [
          'title' => $title,
          'body' => $body,
          'NotificationReceiverId' => $reciverId,
          'NotificationSenderId' => $senderId,
      ];
      $dataBuilder = new PayloadDataBuilder();
      $dataBuilder->addData(['a_data' => $my_data]);

      $option = $optionBuilder->build();
      $notification = $notificationBuilder->build();
      $data = $dataBuilder->build();

      $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

      $downstreamResponse->numberSuccess();
      $downstreamResponse->numberFailure();
      $downstreamResponse->numberModification();

      // return Array - you must remove all this tokens in your database
      $downstreamResponse->tokensToDelete();

      // return Array (key : oldToken, value : new token - you must change the token in your database)
      $downstreamResponse->tokensToModify();

      // return Array - you should try to resend the message to the tokens in the array
      $downstreamResponse->tokensToRetry();

      // return Array (key:token, value:error) - in production you should remove from your database the tokens
      $downstreamResponse->tokensWithError();
      return $downstreamResponse->numberSuccess();
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

    public function projectJobsList($projectId)
    {
      return response()->json([
        'jobsList' => JobResource::collection(Job::where('project_id','=',$projectId)->get()),
      ]);
    }

    public function jobDetail($id)
    {
      return response()->json([
        'jobDetail' => new JobResource(Job::find($id)),
      ]);
    }

    public function jobTasksList($jobId)
    {
      return response()->json([
        'jobTasksList' => DayResource::collection(Day::where('job_id','=',$jobId)->get()),
      ]);
    }

    public function jobTaskDetail($taskId)
    {
      return response()->json([
        'jobTaskDetail' => new DayResource(Day::find($taskId)),
      ]);
    }

    public function startJobTime(Request $request)
    {
        $year = date('Y');
        $week = date('W');
        $day = date('D');
        $check_in_time = date('H:i');
        // check whether entry of this weeknumber exist or note
        // return response()->json([
        //   'request' => $request->jobIds,
        // ]);
        foreach ($request->jobIds as $key => $id) {

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
        }
      return response()->json([
        'request' => $request->jobIds,
      ]);
  }// startJobTime ends here


    private function calculateTime($timeCard){
        $startTime = $timeCard->check_in_time;
        $endTime = $timeCard->check_out_time;
        $startTime = new DateTime($startTime);
        $endTime = new DateTime($endTime);
        if ($startTime > $endTime) {
          $test = true;
          $endTime->add(new DateInterval('PT24H'));
        }
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

    public function endJobTime(Request $request)
    {
      $header = $request->header('language');
      $countryTimezones = Config::get('countryTimezones');
      $startedJobs = $request->startedJobs;
      $endJobs = $request->endJobs;
      $note = $request->note;

      $user_id = Auth::user()->id;
      $company_id  = DB::table('users')
                  ->where('id','=',$user_id)
                  ->value('company_id');

      $day_id = $endJobs[0];
      $project_id  = DB::table('days')
                  ->where('id','=',$day_id)
                  ->value('project_id');

      $shift_count = DB::table('shifts')
                ->where('company_id','=',$company_id)
                ->count();

      // $notFinishedJobs = array_diff($startedJobs, $endJobs); // keys of jobs not finished yet
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

        // $time_starts  = '00:00:00'; 
        // $server_time  = '11:10:00'; 
        // $current_time = '12:10:00'; 
        // $time_ends    = '13:00:00'; 

        if ($time_starts > $time_ends) {
          if (strtotime($current_time) < strtotime($time_ends) && strtotime($server_time) < strtotime($time_ends)) {
              $year = date('Y', strtotime('-1 day'));
              $week = date('W', strtotime('-1 day'));
              $day = date('D', strtotime('-1 day'));
          } 
        }
      }  

      $check_out_time = date('H:i');
      $weeknumber = $year.$week;

      //for each loop to stop time for end jobs
      foreach ($endJobs as $key => $id) {
        $weekCard = WeekCard::where('weeknumber','=',$weeknumber)
                            ->where('days_id','=',$id)
                            ->first();

        $timeCard = TimeCard::where('week_cards_id','=',$weekCard->id)
                    ->where('day_name','=',$day)
                    ->first();

        $timeCard->check_out_time = $check_out_time;
        $timeCard->job_status_id = 3;// Finished
        $total_time = $this->calculateTime($timeCard);
        $timeCard->total_time = $total_time;
        $timeCard->note = $note;
        $timeCard->save();

        //now update weekcard columns
        $column = strtolower($day); //will return mon, or ..,sun
        $weekCard->$column = $total_time;
        $time_per_week = $weekCard->total_hours_per_week;
        $new_time = $this->totalWeekTime($time_per_week,$total_time);
        $weekCard->total_hours_per_week = $new_time;
        $weekCard->save();
      } // end for loop for endjobs

      // // foreach loop for jobs that were started but not stoped, action is to delete timecard entry for those jobs
      // foreach ($notFinishedJobs as $key => $id) {
      //   $weekCard = WeekCard::where('weeknumber','=',$weeknumber)
      //                       ->where('days_id','=',$id)
      //                       ->first();

      //   $timeCard = TimeCard::where('week_cards_id','=',$weekCard->id)
      //               ->where('day_name','=',$day)
      //               ->delete();
      // } // end of foreach for not fisnished jobs

      ////////////Notifications starts from here////////////
      $day_id = $endJobs[0];
      $day = Day::find($day_id);
      $inspectorId = $day->project->inspector_id;
      $senderId = Auth::user()->id;
      $supervisorId = Auth::user()->reports_to_id;
      $sup_insp_ids= [$supervisorId];

      if(!is_null($inspectorId)){
        $sup_insp_ids[1] = $inspectorId;
      }

      $reciverId = $sup_insp_ids;
      $tokens = User::whereIn('id',$sup_insp_ids)
                  ->pluck('fcm_token')->toArray();

      if ($header == 'en') {
        $title = "Job done";
        $body = 'Job completed by '.Auth::user()->name.'. Job strted at: '.$timeCard->check_in_time.'. Job Finished at: '.$timeCard->check_out_time.'. Project name: '.$day->project->name.'. Job Location: '.$day->location->name.'. Project Id: '.$day->project->id.'. Worker Id: '.Auth::user()->id;
      }else{
        $title = "Klus geklaard";
        $body = 'Taak voltooid door '.Auth::user()->name.'. Job vastgesteld op: '.$timeCard->check_in_time.'. Taak voltooid op: '.$timeCard->check_out_time.'. Projectnaam: '.$day->project->name.'. Werklocatie: '.$day->location->name.'. Project Id: '.$day->project->id.'. Worker Id: '.Auth::user()->id;
      }

      $payLoadData= $this->multipleNotifications($title, $body,$tokens, $reciverId,$senderId);

      foreach ($sup_insp_ids as $id) {
         $notification = new Notification;
         $notification->title = $title;
         $notification->body  = $body;
         $notification->remarks  = $note;
         $notification->status  = 0;
         $notification->reciever_id = $id;
         $notification->sender_id = $senderId;
         $notification->created_at = Carbon::now()->setTimezone('Europe/Amsterdam');
         $notification->save();
      }

      ////////////Notifications ends here////////////
        $message = ($header == 'en')? 'Job marked done successfully' : 'Taak gemarkeerd als succesvol voltooid';

        return response()->json([
          'status' => true,
          'message' => $message,
        ]);
    }// endJobTime ends here
}

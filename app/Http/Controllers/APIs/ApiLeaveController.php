<?php

namespace App\Http\Controllers\APIs;
use Auth;
use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Leave;
use App\Models\LeaveUser;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Resources\LeaveResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class ApiLeaveController extends Controller
{
    public function leavePermission(Request $request)
    {
         $header = $request->header('language');
         $user_id = Auth::user()->id;
         $user_company_id = Auth::user()->company_id;
         $permission = User::select('allow_leaves')->where('id','=',$user_company_id)->first();

         if ($permission) {
            $message = ($header == 'en') ? 'Leave Permission Assigned' : 'Laat toestemming toegewezen' ;
         }else {
            $message = ($header == 'en') ? 'Leave Permission Not Assigned' : 'Laat toestemming niet toegewezen' ;
         }
         return response()->json([
             'status' => true,
             'message' => $message,
             'permission' => ($permission->allow_leaves=="1")? true:false,
         ]);
      }

      public function myleaves(Request $request)
      {
         $user_id = Auth::user()->id;
         $user = Auth::user();
         $leaves = LeaveResource::collection($user->leaves);

         $header = $request->header('language');

         if ($leaves) {
            $message = ($header == 'en') ? 'Leaves Found.' : 'Bladeren gevonden.';
         }else {
            $message = ($header == 'en') ? 'No Leaves Found.' : 'Geen bladeren gevonden.' ;
         }

         return response()->json([
             'status' => ($leaves) ? true : false,
             'message' => $message,
             'leaves' => $leaves,
         ]);
      }//myleaves ends here

      public function myrejectedleaves(Request $request)
      {
         $user_id = Auth::user()->id;
         $user = Auth::user();
         $leave_ids = LeaveUser::where('user_id','=',$user_id)->pluck('id');
         $leaves = LeaveResource::collection(Leave::whereIn('id',$leave_ids)->where('status_id','=',3)->get());

         $header = $request->header('language');

         if ($leaves) {
            $message = ($header == 'en') ? 'Rejected Leaves Found.' : 'Afgewezen bladeren gevonden.' ;
         }else {
            $message = ($header == 'en') ? 'No Rejected Leaves Found.' : 'Geen afgekeurde bladeren gevonden.' ;
         }

         return response()->json([
             'status' => ($leaves) ? true : false,
             'message' => $message,
             'leaves' => $leaves,
         ]);
      }//myleaves ends here


       public function multipleNotifications($title, $body,$tokens,$reciverId,
   $senderId)
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

      public function leaverequest(Request $request)
      {
        $this->validate($request,[
            'details' => 'required|max:255',
            'leave_type_id' => 'required',
            'start_date' => 'required',
        ]);

        if($request->leave_type_id == 2){
            $this->validate($request,[
                  'end_date' => 'required',
            ]);
        }

        $user_id = Auth::user()->id;
        $supervisor_id = Auth::user()->reports_to_id;
        $manager_id = User::select('reports_to_id')
                          ->where('id','=',$supervisor_id)
                          ->first();

        $sup_manager_ids = [$supervisor_id,$manager_id->reports_to_id];
        $approvedBy_arr = [];
        $approvedBy_arr[0] = ["role"=>"supervisor","id"=>$supervisor_id,"comment"=>"", "status"=>false];

        $approvedBy_arr[1] = ["role"=>"manager","id"=>$manager_id->reports_to_id,"comment"=>"", "status"=>false];

        // return $approvedBy_arr;

        $leave = new Leave;
        $leave->details = $request->details;
        $leave->start_date = $request->start_date;
        $leave->end_date = ($request->leave_type_id == 2)? $request->end_date : "";
        $leave->status_id = 1; //initially pending status

        $leave->leave_type_id = $request->leave_type_id;
        $leave->save();

        $leave_user = new LeaveUser;
        $leave_user->user_id = $user_id;
        $leave_user->leave_id = $leave->id;
        $leave_user->reports_to_id = $supervisor_id;
        $leave_user->approved_by = json_encode($approvedBy_arr);
        $leave_user->save();

        //////////////Notification starts here ////////////////
        $tokens = User::whereIn('id',$sup_manager_ids)
                        ->pluck('fcm_token')->toArray();

        $reciverId = $sup_manager_ids;
        $senderId = Auth::user()->id;
        $header = $request->header('language');

        $leaveType = $leave->leave_type->name;
        $leaveTypeId = $leave->leave_type->id;
        $start_date = $leave->start_date;
        $end_date = $leave->end_date;
        $title = '';
        $body = '';
       if ($header=='en') {
          $title = $leaveType.' Request';
          $body = 'Request for '.$leaveType.' from '.Auth::user()->name.'. Leave start date: '.$start_date.', End date: '.$end_date."." ;
       }else{
          $leaveName = ($leaveType == 'Hollidays Leave') ? 'Vakantie Verzoek' : 'Ziekmelding Verzoek';

          $title = $leaveName;
          // $opening = ($leaveTypeId == 1)? 'Ziekmelding':'Vakantie';
          $endDate = '. Einddatum : '.$end_date.".";
          $ending = ($leaveTypeId == 1)? '.':$endDate;
          $body = $leaveName.' van '.Auth::user()->name.'. Startdatum : '.$start_date.$ending ;
       }


        $payLoadData= $this->multipleNotifications($title, $body,$tokens, $reciverId,$senderId);

        $notification = new Notification;
        $notification->title = $title;
        $notification->body  = $body;
        $notification->status  = 0;
        $notification->reciever_id = $supervisor_id;
        $notification->sender_id = $senderId;
        $notification->created_at = Carbon::now()->setTimezone('Europe/Amsterdam');
        $notification->save();
        //////////////Notification ends here ////////////////

        if ($leave->id) {
           $message = ($header == 'en') ? 'Success, Leave created.' : 'Success, Leave made.' ;
        }else {
           $message = ($header == 'en') ? 'Error, Leave not created.' : 'Fout, verzuim om verlof te creëren' ;
        }
        return response()->json([
            'status' => ($leave->id) ? true : false,
            'message' => $message,
            'leave_id' => $leave->id,
            'payLoadData' => $payLoadData,
        ]);
 }//leaverequest ends here

}

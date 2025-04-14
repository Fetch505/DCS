<?php
namespace App\Http\Controllers\APIs;
use Auth;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ApiNotificationController extends Controller
{
    public function myNotifications(Request $request)
    {
      $header = $request->header('language');
      $my_id = Auth::user()->id;
      $notifications = Notification::where('reciever_id','=',$my_id)
                                   ->where('status','=',0)->latest()
                                   ->get();

      $unreadNoti_Count = Notification::where('reciever_id','=',$my_id)
                                   ->where('status','=',0)
                                   ->count();

     $message = ($header == 'en') ? 'List of My Notifications' : 'Lijst met mijn meldingen';

      return response()->json([
          'status' => true,
          'message' => $message,
          'unreadNotificationCount' => $unreadNoti_Count,
          'notifications' => $notifications,
      ]);
    }

    public function markread(Request $request,$id)
    {
      $header = $request->header('language');

      Notification::where('id','=',$id)->update([
        'status' => 1
      ]);
      $my_id = Auth::user()->id;

      $notifications = Notification::where('reciever_id','=',$my_id)
                    ->where('status','=',0)
                    ->latest()
                    ->get();

      $unreadNoti_Count = Notification::where('reciever_id','=',$my_id)
            ->where('status','=',0)
            ->count();

      $readNotifications = Notification::where('reciever_id','=',$my_id)
            ->where('status','=',1)
            ->get();


     $message = ($header == 'en') ? 'List of My Notifications' : 'Lijst met mijn meldingen';

      return response()->json([
          'status' => true,
          'message' => $message,
          'unreadNotificationCount' => $unreadNoti_Count,
          'notifications' => $notifications,
          'readNotifications'=> $readNotifications,

      ]);
    }

//    public function deleteNotification(Request $request,$id)
//    {
//        $header = $request->header('language');
//
//        Notification::where('id','=',$id)->update([
//            'status' => 2
//        ]);
//        $my_id = Auth::user()->id;
//        $notifications = Notification::where('reciever_id','=',$my_id)
//            ->where('status','=',0)
//            ->latest()
//            ->get();
//
//        $unreadNoti_Count = Notification::where('reciever_id','=',$my_id)
//            ->where('status','=',0)
//            ->count();
//
//        $message = ($header == 'en') ? 'List of My Notifications' : 'Lijst met mijn meldingen';
//
//        return response()->json([
//            'status' => true,
//            'message' => $message,
//            'unreadNotificationCount' => $unreadNoti_Count,
//            'notifications' => $notifications,
//        ]);
//    }
}

<?php

namespace App\Http\Controllers\APIs;

use Auth;
use Mail;
use DateTime;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ReplacementRequest;
use App\Mail\ReplacementRequest as ReplacementRequestMail;
use App\Http\Controllers\Controller;

class ReplacementRequestController extends Controller
{
    public function makeRequest(Request $request)
    {
      $header = $request->header('language');
      $newRequest = new ReplacementRequest;
      $newRequest->supervisor_id    = Auth::id();
      $newRequest->user_id          = $request->worker_id;
      $newRequest->type             = $request->type;
      $newRequest->remarks          = $request->remarks;
      $newRequest->project_id       = $request->project_id;
      $newRequest->from             = $request->from ? date('Y-m-d', strtotime($request->from)) : null;
      $newRequest->to               = $request->to ? date('Y-m-d', strtotime($request->to)) : null;
      $newRequest->status           = 0;

      if($request->from && $request->to) {
          $newRequest->count        = $this->calculateDaysCount($request->from, $request->to);
      } else {
          $newRequest->count        = 0;
      }

      $newRequest->save();

      // Email work below
      $employee = User::findOrFail($request->worker_id);
      // return $employee;

      $emp_name             = $employee->name;
      $emp_agency           = $employee->agency->name;
      // return $emp_agency;
      $emp_agency_email     = $employee->agency->email;
      $from                 = $newRequest->from;
      $to                   = $newRequest->to;
      $type                 = $newRequest->type;
      $remarks              = $newRequest->remarks;
      $address              = $newRequest->project->address . ', ' . $newRequest->project->city;


      try {
          Mail::to($emp_agency_email)->send(new ReplacementRequestMail($emp_agency, $emp_name, $from, $to, $type, $remarks, $newRequest->project->name, $address));
          $newRequest->status = 1;
          $newRequest->save();

      } catch (Exception $e) {

      }



      return response()->json([
          'status' => 1,
          'message' => 'Replacement request has been sent'
      ]);

    }

    private function calculateDaysCount($from, $to)
    {
        $datetime1  = new DateTime($from);
        $datetime2  = new DateTime($to);
        $interval   = $datetime1->diff($datetime2);
        $days       = $interval->format('%a');
        return $days + 1;
    }
}

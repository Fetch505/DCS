<?php

namespace App\Http\Controllers\CompanyAdmin;
use URL;
use DB;
use PDF;
use App;
use Hash;
use Auth;
use Lang;
use Session;
use Carbon\Carbon;
use App\Models\Shift;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $company_id = Auth::id();
      $shifts = Shift::where('company_id', '=', $company_id)->get();
      return view('Company_Admin.shifts.index')->withShifts($shifts);
    }

    public function create()
    {
        return view('Company_Admin.shifts.add');
    }

    public function store(Request $request)
    {
      $request->validate([
          'title' => 'required|max:255',
          'description' => 'max:255',
          'time_starts' => 'required',
          'time_ends' => 'required',
          'total_time' => 'required',
      ]);

      try{

          $cushion = $request->time_cushion;
          if($cushion > 0){
            $total_hours = floor($cushion / 60);
            $cushion %= 60;
            $time_cushion = $total_hours . ':' . $cushion;
          }
          else{
              $time_cushion = '0:0';
          }

          $company_id = Auth::id();
          $shift = new Shift;
          $shift->title = $request->title;
          $shift->description = $request->description;
          $shift->time_starts = $request->time_starts;
          $shift->time_ends = $request->time_ends;
          $shift->total_time = $request->total_time;
          $shift->time_cushion = $time_cushion;
          $shift->company_id = $company_id;
          $shift->created_at = Carbon::now();
          $shift->updated_at = Carbon::now();
          $shift->save();

          $message = 'Video Uploaded';
      }
      catch  (\Exception $e){
          $message = $e->getMessage();
      }

      return response()->json([
          'status' => 1,
          'message' => $message,
      ], 200);
    }


    public function edit(Shift $shift)
    {
      if ($shift->time_cushion){
        $timeParts = explode(':', $shift->time_cushion);
        $hours = (int)$timeParts[0];
        $minutes = (int)$timeParts[1];

        $totalMinutes = $hours * 60 + $minutes;
        $shift->time_cushion = $totalMinutes;
      }

      return view('Company_Admin.shifts.edit', [
        'shift' => $shift,
        'exception' => false,
      ]);
    }

    public function update(Request $request, Shift $shift)
    {
      $request->validate([
        'title' => 'required|max:255',
        'description' => 'max:255',
        'time_starts' => 'required',
        'time_ends' => 'required',
        'total_time' => 'required',
      ]);

      try{

        $cushion = $request->time_cushion;
        if($cushion > 0){
          $total_hours = floor($cushion / 60);
          $cushion %= 60;
          $time_cushion = $total_hours . ':' . $cushion;
        }
        else{
            $time_cushion = '0:0';
        }

        $shift = Shift::where('id','=',$shift->id)->first();;
        $shift->title = $request->title;
        $shift->description = $request->description;
        $shift->time_starts = $request->time_starts;
        $shift->time_ends = $request->time_ends;
        $shift->total_time = $request->total_time;
        $shift->time_cushion = $time_cushion;
        $shift->updated_at = Carbon::now();
        $shift->save();
      }
      catch  (\Exception $e){
            Log::error('An error occurred: ' . $e->getMessage());
      }

      $shift->time_cushion = $request->time_cushion;

      return view('Company_Admin.shifts.edit', [
        'shift' => $shift,
        'exception' => false,
      ]);
    }

    public function deleteRecord(Shift $shift)
    {
        Shift::where('id','=',$shift->id)->delete();
        return redirect()->route('shift.index');
    }

}

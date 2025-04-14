<?php

namespace App\Http\Controllers\APIs;
use Auth;
use App\Models\Day;
use App\Models\Leave;
use Illuminate\Http\Request;
use App\Http\Resources\DayResource;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function home()
    {// return count of tasks
      $user_id = Auth::user()->id;
      $daily_jobs_count = Day::where('type','=','daily')->where('user_id','=',$user_id)->count();

      $weekly_jobs_count = Day::where('type','=','weekly')->where('user_id','=',$user_id)->count();

      return response()->json([
          'dailyJobsCount' => $daily_jobs_count,
          'weeklyJobsCount' => $weekly_jobs_count,
      ]);
    }

    public function allWeeklyJobs()
    {// return weekly jobs
      $user_id = Auth::user()->id;

      return response()->json([
          'weeklyJobsCount' => DayResource::collection (Day::where('type','=','weekly')->where('user_id','=',$user_id)->orderBy('created_at', 'desc')->get()),
      ]);
    }

    public function allDailyJobs()
    {// return weekly jobs
      $user_id = Auth::user()->id;

      return response()->json([
          'dailyJobs' => DayResource::collection (Day::where('type','=','daily')->where('user_id','=',$user_id)->orderBy('created_at', 'desc')->get()),
      ]);
    }
}

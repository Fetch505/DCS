<?php

namespace App\Http\Controllers\CompanyAdmin;
use App;
use Session;
use Auth;
use DateTime;
use DateInterval;
use App\Models\User;
use App\Models\TimeCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class WorkerReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_id = Auth::user()->id;
        $worker=User::where('company_id',Auth::id())->where('name','!=',null)->where('role_id',3)->orderBy('name', 'asc')->get();
        $project =DB::table('projects')->where('company_id',Auth::id())->orderBy('name', 'asc')->get();
        $shifts =DB::table('shifts')->where('company_id',Auth::id())->get();
        $worker_report=[];
        $summary_report=[];
        $shift_count = DB::table('shifts')
                ->where('company_id','=',$company_id)
                ->count();
        return view('Company_Admin.worker_reports.index',compact('worker','project','worker_report','summary_report','shift_count','shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function convert_timezone(&$report)
    {
        $country = $report->country;
        $created = $report->created_at;
        $check_in = $report->check_in_time;
        $check_out = $report->check_out_time;

        $carbonTime = Carbon::parse($created);
        $date = $carbonTime->toDateString();

        $countryTimezones = Config::get('countryTimezones');

        if ($country && isset($countryTimezones[$country])) {
            $timezonecountry = $countryTimezones[$country];

            if (!is_null($created)) {
                $report->created_at = $this->convertTimestamp($created, $timezonecountry);
            }

            if (!is_null($check_in)) {
                $check_in = $date . ' ' . $check_in;
                $report->check_in_time = $this->convertTimestamp($check_in, $timezonecountry, 'H:i:s');
            }

            if (!is_null($check_out)) {
                $check_out = $date . ' ' . $check_out;
                $report->check_out_time = $this->convertTimestamp($check_out, $timezonecountry, 'H:i:s');
            }
        }
    }

    private function convertTimestamp($timestamp, $timezone, $format = 'Y-m-d H:i:s')
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, config('app.timezone'))
            ->setTimezone($timezone)
            ->format($format);
    }

    public function getprojectsforworker($workerId)
    {

        $results = DB::table('days')
        ->join('projects', 'days.project_id', '=', 'projects.id')
        ->select('projects.name', 'projects.id')
        ->where('days.user_id', $workerId)
        ->distinct()
        ->get();

        return response()->json($results);
    }

    public function getWorkerTaskDetails(Request $request)
    {
        $worker_report=[];
        $summary_report=[];

        if ($request->worker_id == null && $request->project_id == null && $request->StartDate == null && $request->EndDate == null) {
            return redirect()->back()->with('message','The Field is required');
        }

        $worker_report = DB::table('users')
            ->join('days', 'users.id', '=', 'days.user_id')
            ->join('projects', 'projects.id', '=', 'days.project_id')
            ->join('tasks', 'tasks.id', '=', 'days.task_id')
            ->leftJoin('week_cards', 'week_cards.days_id', '=', 'days.id')
            ->leftJoin('time_cards', 'time_cards.week_cards_id', '=', 'week_cards.id')
            ->leftJoin('shifts', 'shifts.id', '=', 'users.shift_id')
            ->join('locations', 'locations.project_id', '=', 'projects.id')
            ->where('users.company_id', Auth::user()->id)
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
            ->select('users.name as worker_name', 'days.project_id', 'locations.name as location_name', 'tasks.name as tasks_name', 'projects.country as country','projects.name as project_name', 'time_cards.id as time_card_id', 'time_cards.created_at', 'time_cards.check_in_time', 'time_cards.check_out_time', 'time_cards.total_time', 'shifts.title as shift_title')
            ->orderByDesc('time_cards.created_at')
            ->get();

        foreach($worker_report as $key => $report){
            $this->convert_timezone($report);
        }

        $input = $request->all();

        return redirect()->back()
        ->withInput($input)
        ->with([
            'worker_report'=>$worker_report,
            'summary_report'=>$summary_report]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
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

    public function updateReport(Request $request, $id)
    {
        $countryTimezones = Config::get('countryTimezones');
        $check_in = $request->check_in_time;
        $check_out = $request->check_out_time;
        $country = $request->country;
        $created = $request->created_at;

        $carbonTime = Carbon::parse($created);
        $date = $carbonTime->toDateString();

        $countryTimezones = Config::get('countryTimezones');

        if ($country && isset($countryTimezones[$country])) {
            $timezonecountry = $countryTimezones[$country];

            if (!is_null($check_in)) {
                $check_in_time = $date . ' ' . $check_in;
                $check_in_time = date('Y-m-d H:i:s', strtotime($check_in_time));
                $check_in = Carbon::createFromFormat('Y-m-d H:i:s', $check_in_time, $timezonecountry)
                                ->setTimezone(config('app.timezone'))
                                ->format('H:i:s');
            }

            if (!is_null($check_out)) {
                $check_out_time = $date . ' ' . $check_out;
                $check_out_time = date('Y-m-d H:i:s', strtotime($check_out_time));
                $check_out = Carbon::createFromFormat('Y-m-d H:i:s', $check_out_time, $timezonecountry)
                                ->setTimezone(config('app.timezone'))
                                ->format('H:i:s');
            }
        }

        $time_card = TimeCard::where('id',$id)->first();
        $time_card->check_in_time = $check_in;
        $time_card->check_out_time = $check_out;
        $total_time = $this->calculateTime($time_card);
        $time_card->total_time = $total_time;
        $time_card->save();

        return response()->json([
            'message' => 'success',
            'status'  => 1
          ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

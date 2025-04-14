<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Http\Resources\ProjectResource;

use DB;
use PDF;
use App;
use Auth;
use Session;
use Illuminate\Support\Arr;
use function Psy\debug;
use Carbon\Carbon;
use App\Models\Job;
use App\Models\Day;
use App\Models\Task;
use App\Models\User;
use App\Models\Role;
use App\Models\Floor;
use App\Models\Area;
use App\Models\Element;
use App\Models\Material;
use App\Models\MaterialCategory;
use App\Models\MaterialType;
use App\Models\Project;
use App\Models\Location;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\TimeCard;
use App\Models\FloorType;
use App\Models\Permission;
use App\Models\ProjectElement;
use App\Http\Resources\DayResource;
use App\Http\Resources\JobResource;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index()
    {
        $company_id = Auth::id();
        $projects   = Project::where('company_id', '=', $company_id)->get();
        
        foreach ($projects as $key=>$project) {
            $user_ids   = [];
            foreach ($project->jobs as $key=>$job) {
                foreach ($job->days as $key=>$day) {
                    if($day->status == 1){
                        $user_ids[] = $day->user->id;
                    }
                }
            }
            $user_ids = array_unique($user_ids);
            $totalWorkers = count($user_ids);
            $project->totalWorkers = $totalWorkers;
        }
        return view('Company_Admin.project.index')->withProjects($projects);
    }

    public function create()
    {
        $areas      = Area::all();
        $floors     = Floor::all();
        $floorTypes = FloorType::all();
        $customers  = Customer::where('company_id', '=', Auth::id())
                              ->pluck('name','id');

        $elements = Element::all();
        $tasks    = Task::all();
        $comp_id  = Auth::user()->company_id;
        $role     = Role::select('id')->where('name','=','user')->first();
        $workers  = User::select('name','id')
                       ->where('status','=',1)
                       ->where('role_id','=',$role->id)
                       ->where('company_id','=',$comp_id)
                       ->get();

        return view('Company_Admin.project.add',compact('areas','floors','customers','elements','tasks','workers','floorTypes'));
    }

    public function show($id)
    {
        $project   = Project::where('projects.id','=',$id)->first();
        $floor_ids = [];
        $user_ids   = [];
        $area_ids  = [];
        foreach ($project->jobs as $key=>$job) {
            $floor_ids[$key] = $job->floor_id;
            foreach ($job->days as $key=>$day) {
                if($day->status == 1){
                    $user_ids[] = $day->user->id;
                }
            }
        }
        $user_ids = array_unique($user_ids);
        $totalWorkers = count($user_ids);
        $floors = Floor::select('id','name')
                        ->whereIn('id',$floor_ids)
                        ->orderBy('name','asc')
                        ->get();
        return view('Company_Admin.project.view',compact('project','floors','totalWorkers'));
    }

    public function edit(Project $project)
    {
        $areas     = Area::all();
        $floors    = Floor::all();
        $customers = Customer::where('company_id', '=', Auth::id())
                                ->pluck('name','id');
        $floorTypes = FloorType::all();
        $elements   = Element::all();
        $tasks      = Task::all();
        $comp_id    = Auth::user()->company_id;
        $role       = Role::select('id')->where('name','=','user')->first();
        $workers    = User::select('name','id')
                            ->where('role_id','=',$role->id)
                            ->where('status','=',1)
                            ->where('company_id','=',$comp_id)
                            ->get();

        $user_ids   = [];
        foreach ($project->jobs as $key=>$job) {
            foreach ($job->days as $key=>$day) {
                if($day->status == 1){
                    $user_ids[] = $day->user->id;
                }
            }
        }
        $user_ids = array_unique($user_ids);
        $totalWorkers = count($user_ids);

        return view('Company_Admin.project.edit',compact('areas','floors','customers','elements','tasks','workers','project','floorTypes','totalWorkers'));
    }

    public function deleteRecord(Project $project)
    {
        DB::table('locations')->where('project_id','=',$project->id)->delete();
        DB::table('project_jobs')->where('project_id','=',$project->id)->delete();
        DB::table('days')->where('project_id','=',$project->id)->delete();
        $project->delete();
        if (App::getLocale() == "en") {
             Session::flash('success','Project deleted successfully');
           }else {
             Session::flash('success','Project succesvol verwijderd');
           }
        return redirect()->route('project.index');
    }

    public function removeLocation($id)
    {
        DB::table('locations')->where('id','=',$id)->delete();
    }

    public function CalculateArea()
    {
        dd('calculate area');
    }

    public function projectDetails($id){
        $project   = Project::find($id);
        $customers = Customer::all();
        $comp_id   = Auth::user()->id;

        $supervisor_role = Role::select('id')->where('name','=','supervisor')->first();
        $supervisors = User::select('name','id')
                            ->where('role_id','=',$supervisor_role->id)
                            ->where('company_id','=',$comp_id)
                            ->where('status','=',1)
                            ->orderBy('name', 'asc')
                            ->get();

        $workers = User::select('name','id', 'employee_code')
                            ->where('company_id', '=', $comp_id)
                            ->where('reports_to_id', '=', $project->supervisor_id)
                            ->where('status','=',1)
                            ->get();

        $insp_perm_id = Permission::select('id')
                                    ->where('name','=','give feedback')
                                    ->first();

        $inspectors = DB::table('users')
        ->join('users_permissions','users_permissions.user_id','=','users.id')
        ->where('users.company_id', '=', $comp_id)
        ->where('users_permissions.permission_id','=',$insp_perm_id->id)
        ->where('users.status','=',1)
        ->select('users.name','users.id')
        ->get();

        return response()->json([
            'data' => [
                'project' => new ProjectResource($project),
                'customers' => $customers,
                'supervisors' => $supervisors,
                'inspectors' => $inspectors,
                'workers' => $workers,
            ]
        ],200);
    }

    public function dayDetails($id)
    {
        $day        = Day::findOrFail($id);
        $day->week_number   = json_decode($day->week_number);
        $comp_id    = Auth::user()->id;
        $workingDay = null;
        if($day->type === 'weekly') {
            $workingDay = $this->workingDay($day);
        }
        $floor_id   = $day->job->floor->id;
        $floor_name = $day->job->floor->name;
        $floors     = Floor::select('id', 'name')
                          ->where('company_id','=',$comp_id)
                          ->orderBy('name', 'asc')
                          ->get();

        $areas      = Area::select('id', 'name')
                          ->where('company_id','=',$comp_id)
                          ->orderBy('name', 'asc')
                          ->get();

        $role       = Role::select('id')->where('name','=','user')->first();
        $workers    = User::select('name','id', 'employee_code')
                          ->where('role_id','=',$role->id)
                          ->where('company_id','=',$comp_id)
                          ->where('status','=',1)
                          ->orderBy('name', 'asc')
                          ->get();
        $tasks      = Task::orderBy('name', 'asc')->get();
        $types      = ['daily' => 'Daily', 'weekly' => 'Weekly'];
        $elements   = Element::orderBy('name', 'asc')->get();

        return response() -> json([
            'data' => [
                'day'           => $day,
                'workingDay'    => $workingDay,
                'floor_id'      => $floor_id,
                'floor_name'    => $floor_name,
                'areas'         => $areas,
                'floors'        => $floors,
                'workers'       => $workers,
                'tasks'         => $tasks,
                'types'         => $types,
                'elements'      => $elements,
            ]
        ], 200);
    }

    public function saveEditJob(Request $request, $id)
    {
      // return $request->all();
        $day = Day::findOrFail($id);
        $loc_name = $request->location;
        $project_id = $day->project_id;

        $day->user_id  = $request->worker_id;
        $day->type      = $request->type;
        if ($request->type == 'daily') {
            $day->mon      = $request->mon ? 1 : 0;
            $day->tue      = $request->tue ? 1 : 0;
            $day->wed      = $request->wed ? 1 : 0;
            $day->thu      = $request->thu ? 1 : 0;
            $day->fri      = $request->fri ? 1 : 0;
            $day->sat      = $request->sat ? 1 : 0;
            $day->sun      = $request->sun ? 1 : 0;
            $day->week_number = null;
        } else {
            $day->mon      = 0;
            $day->tue      = 0;
            $day->wed      = 0;
            $day->thu      = 0;
            $day->fri      = 0;
            $day->sat      = 0;
            $day->sun      = 0;
            $day->week_number = json_encode($request['week_number']);
        }

        $day->element_id = $request->element_id;
        $day->task_id = $request->task_id;
        $day->area_id = $request->area_id;

        $loc = $request->location;
        if (!is_string($loc)) {
            $loc_name = $loc['name'];
            $loc_lat = $loc['latitude'];
            $loc_long = $loc['longitude'];

            $location = Location::where('name','=',$loc_name)
                              ->where('latitude','=',$loc_lat)
                              ->where('longitude','=',$loc_long)
                              ->first();

            $day->location_id = $location->id;
        }

        $day->save();

        DB::table('areas_days')
              ->where('day_id','=', $day->id)
              ->update(['area_id' => $request->area_id]);

        return response()->json([
            'message' => 'success',
            'status'  => 1
        ], 200);
    }

    public function addDayDetails()
    {
        // $floors     = Floor::where('company_id', '=', Auth::id())->orderBy('name', 'asc')->get();
        // $floors     = Floor::where('company_id', '=', Auth::id())->orderBy('name', 'asc')->get();
        $floors    = Floor::where('company_id', '=', Auth::id())->select('name','id')->orderBy('name', 'asc')->get();
        $areas     = Area::where('company_id', '=', Auth::id())->select('name','id')->orderBy('name', 'asc')->get();
        $comp_id    = Auth::user()->id;
        $role       = Role::select('id')->where('name','=','user')->first();
        $workers    = User::select('name','id', 'employee_code')
                            ->where('role_id','=',$role->id)
                            ->where('company_id','=',$comp_id)
                            ->where('status','=',1)
                            ->orderBy('name', 'asc')
                            ->get();
        $tasks      = Task::orderBy('name', 'asc')->get();
        $types      = ['daily' => 'Daily', 'weekly' => 'Weekly'];
        //$elements   = Element::orderBy('name', 'asc')->get();

        $elements  = Element::where('company_id', '=', Auth::id())->select('id','name')->orderBy('name', 'asc')->get();

        return response() -> json([
            'data' => [
                'floors'    => $floors,
                'areas'    => $areas,
                'workers'   => $workers,
                'tasks'     => $tasks,
                'types'     => $types,
                'elements'  => $elements,
            ]
        ], 200);
    }

    public function getRelatedWorkers($id)
    {
        $company_id = Auth::user()->id;
        $workers = User::select('name','id')
                    ->where('company_id', '=', $company_id)
                    ->where('reports_to_id', '=', $id)
                    ->where('status','=',1)
                    ->get();
        return response() -> json([
            'data' => [
                'workers' => $workers
            ]
        ], 200);
    }

    public function getRelatedAreas($id)
    {
      $comp_id = Auth::user()->id;
      $areas = Area::select('name','id')
      ->where('company_id', '=', $comp_id)
                    ->where('floor_id', '=', $id)
                    ->get();

        return response() -> json([
            'data' => [
                'areas' => $areas
            ]
        ], 200);
    }

    public function getRelatedElementTypes($id)
    {
      //$comp_id = Auth::user()->id;
      $element_types = FloorType::select('name','id')
      ->where('element_id', '=', $id)
                    //->where('floor_id', '=', $id)
                    ->get();

        return response() -> json([
            'data' => [
                'element_types' => $element_types
            ]
        ], 200);
    }
    public function getRelatedTasks($id)
    {
      //$comp_id = Auth::user()->id;

      //return $id;
      $tasks = Task::select('name','id')
      ->where('element_id', '=', $id)
                    //->where('floor_id', '=', $id)
                    ->get();

        //return $tasks;
        return response() -> json([
            'data' => [
                'tasks' => $tasks
            ]
        ], 200);
    }

    public function deleteJob($id,$project_id)
    {
        $day       = Day::where('id','=',$id)->first();
        $daysCount = DB::table('days')
                        ->where('project_id','=',$project_id)
                        ->where('job_id','=',$day->job_id)
                        ->count();

        if($daysCount == 1){
            Job::where('id','=',$day->job_id)->delete();
        }
        $day->delete();
        return response()->json([
            'status' => true,
            'daysCount' => $daysCount,
        ],200);
    }

    public function updateProjectDetails(Request $request, $id)
    {
        // return $request->all();
        $locale = App::getLocale();
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'customer_id' => 'required',
            'supervisor_id' => 'required',
            'phone' => 'required|',
            //'address' => 'required|max:255',
            //'city' => 'required|max:255',
            'country' => 'required|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            //'houseNumber' => 'required',
            //'postcode' => ['required', 'regex:/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i'],
        ],[
            'phone.regex' => 'Phone Number Must be of Valid format eg: (+31xxxxxxxxx).'
        ]);
        $project                = Project::findOrFail($id);
        $project->name          = $request->name;
        $project->description   = $request->description;
        $project->customer_id   = $request->customer_id;
        $project->supervisor_id = $request->supervisor_id;
        $project->inspector_id  = $request->inspector_id;
        $project->phone         = $request->phone;
        $project->address       = $request->address;
        $project->city          = $request->city;
        $project->country       = $request->country;
        $project->notes         = $request->notes;
        $project->fax           = $request->fax;
        $project->zipcode       = $request->zipcode;
        $project->houseNumber   = $request->houseNumber;
        $project->postcode      = $request->postcode;
        $project->weekcard      = $request->weekcard;
        $project->start_date    = $request->start_date;
        $project->end_date      = $request->end_date;
        $project->break         = $request->break;
        $project->code          = $request->code;
        $project->save();

        $project_id = $project->id;
        $loc =   Location::where('project_id','=',$id)->first();

        if (empty($loc)){
            $loc = new Location;
        }

        foreach ($request->locations as $key => $location) {
            $loc->name       = $location['name'];
            $loc->latitude   = $location['latitude'];
            $loc->longitude  = $location['longitude'];
            $loc->project_id = $project_id;
            $loc->created_at = carbon::now();
            $loc->updated_at = carbon::now();
            $loc->save();
        }

        //jobs
        if(sizeof($request->jobs) > 0) {
            foreach ($request->jobs as $key => $job) {
                foreach ($job['days'] as $key => $day) {
                    // $loc_name = $day['location'];
                    // $location = Location::where('name','=',$loc_name)
                    //       ->where('project_id','=',$project_id)
                    //       ->orderBy('id', 'desc')
                    //       ->first();


                  $pre_day= Day::findOrFail($day['id']);
                  $pre_day->user_id  = $day['worker_id'];
                  // $pre_day->type      = $day['type'];
                  if ($locale == 'en') {
                      $pre_day->type      = strtolower($day['type']);

                  } else {
                      $pre_day->type      = $day['type'] == 'Dagelijks' ? 'daily' : 'weekly';
                  }

                  if ($day['type'] == 'daily' || $day['type'] == 'Daily' || $day['type'] == 'Dagelijks') {
                      $pre_day->mon      = $day['mon'] ? 1 : 0;
                      $pre_day->tue      = $day['tue'] ? 1 : 0;
                      $pre_day->wed      = $day['wed'] ? 1 : 0;
                      $pre_day->thu      = $day['thu'] ? 1 : 0;
                      $pre_day->fri      = $day['fri'] ? 1 : 0;
                      $pre_day->sat      = $day['sat'] ? 1 : 0;
                      $pre_day->sun      = $day['sun'] ? 1 : 0;
                  } else {
                      $pre_day->mon      = $day['mon'] ? 1 : 0;
                      $pre_day->tue      = $day['tue'] ? 1 : 0;
                      $pre_day->wed      = $day['wed'] ? 1 : 0;
                      $pre_day->thu      = $day['thu'] ? 1 : 0;
                      $pre_day->fri      = $day['fri'] ? 1 : 0;
                      $pre_day->sat      = $day['sat'] ? 1 : 0;
                      $pre_day->sun      = $day['sun'] ? 1 : 0;
                      // $day->mon      = 0;
                      // $day->tue      = 0;
                      // $day->wed      = 0;
                      // $day->thu      = 0;
                      // $day->fri      = 0;
                      // $day->sat      = 0;
                      // $day->sun      = 0;
                      // $day->week_number   =  json_encode($job['week_number']);
                  }

                  $pre_day->element_id = $day['element_id'];
                  $pre_day->task_id = $day['task_id'];
                  $pre_day->area_id = $day['area_id'];
                //   $pre_day->location_id = $location['id'];
                  $pre_day->save();

                  DB::table('areas_days')
                        ->where('day_id','=', $pre_day->id)
                        ->update(['area_id' => $pre_day->area_id]);
                }//nested for loop for days
            } // foreach loop ends here
        } // previous jobs 'if' condition ends here

        if(sizeof($request->newJobs) > 0) {
            foreach ($request->newJobs as $key => $job) {
                $loc_name = $job['location']['name'];
                $loc_lat = $job['location']['latitude'];
                $loc_long = $job['location']['longitude'];

                $location = Location::where('name','=',$loc_name)
                                  ->where('latitude','=',$loc_lat)
                                  ->where('longitude','=',$loc_long)
                                  ->first();

                $checkJobExists = Job::where('project_id', '=', $id)->where('floor_id', '=', $job['floor_id'])->first();
                if($checkJobExists) {
                    $day                = new Day;
                    $day->job_id        = $checkJobExists->id;
                    // $day->type          = $job['type'];
                    if ($locale == 'en') {
                        $day->type          = strtolower($job['type']);

                    } else {
                        $day->type          = $job['type'] == 'Dagelijks' ? 'daily' : 'weekly';
                    }

                    $day->task_id       = $job['task_id'];
                    $day->element_id    = $job['element_id'];
                    $day->user_id       = $job['worker_id'];
                    $day->area_id       = $job['area_id'];
                    $day->location_id    = $location->id;
                    $day->project_id    = $project_id;

                    if ($job['type'] == 'Daily' || $job['type'] == 'Dagelijks' ) {
                        $day->mon           = $job['mon'] ? 1 : 0;
                        $day->tue           = $job['tue'] ? 1 : 0;
                        $day->wed           = $job['wed'] ? 1 : 0;
                        $day->thu           = $job['thu'] ? 1 : 0;
                        $day->fri           = $job['fri'] ? 1 : 0;
                        $day->sat           = $job['sat'] ? 1 : 0;
                        $day->sun           = $job['sun'] ? 1 : 0;
                        $day->week_number   =  null;
                    } else {
                        $day->mon      = 0;
                        $day->tue      = 0;
                        $day->wed      = 0;
                        $day->thu      = 0;
                        $day->fri      = 0;
                        $day->sat      = 0;
                        $day->sun      = 0;
                        $day->week_number   =  json_encode($job['week_number']);
                    }
                    $day->save();
                } else {
                    $newJob = new Job;
                    $newJob->project_id = $project_id;
                    $newJob->floor_id   = $job['floor_id'];
                    $newJob->save();

                    $day                = new Day;
                    $day->job_id        = $newJob->id;
                    // $day->type          = $job['type'];
                    if ($locale == 'en') {
                        $day->type          = strtolower($job['type']);

                    } else {
                        $day->type          = $job['type'] == 'Dagelijks' ? 'daily' : 'weekly';
                    }
                    $day->task_id       = $job['task_id'];
                    $day->element_id    = $job['element_id'];
                    $day->user_id       = $job['worker_id'];
                    $day->area_id       = $job['area_id'];
                    $day->location_id    = $location->id;
                    $day->project_id    = $project_id;

                    if ($job['type'] == 'Daily' || $job['type'] == 'Dagelijks') {
                        $day->mon           = $job['mon'] ? 1 : 0;
                        $day->tue           = $job['tue'] ? 1 : 0;
                        $day->wed           = $job['wed'] ? 1 : 0;
                        $day->thu           = $job['thu'] ? 1 : 0;
                        $day->fri           = $job['fri'] ? 1 : 0;
                        $day->sat           = $job['sat'] ? 1 : 0;
                        $day->sun           = $job['sun'] ? 1 : 0;
                        $day->mon           = $job['mon'] ? 1 : 0;
                    } else {
                        // $day->mon      = ($job['workingDay'] == 'mon') ? 1 : 0;
                        // $day->tue      = ($job['workingDay'] == 'tue') ? 1 : 0;
                        // $day->wed      = ($job['workingDay'] == 'wed') ? 1 : 0;
                        // $day->thu      = ($job['workingDay'] == 'thu') ? 1 : 0;
                        // $day->fri      = ($job['workingDay'] == 'fri') ? 1 : 0;
                        // $day->sat      = ($job['workingDay'] == 'sat') ? 1 : 0;
                        // $day->sun      = ($job['workingDay'] == 'sun') ? 1 : 0;
                        $day->mon      = 0;
                        $day->tue      = 0;
                        $day->wed      = 0;
                        $day->thu      = 0;
                        $day->fri      = 0;
                        $day->sat      = 0;
                        $day->sun      = 0;
                        $day->week_number   =  json_encode($job['week_number']);
                    }
                    $day->save();
                }
            } // foreach loop ends here
        } // if condition ends here

        if (App::getLocale() == "en") {
             Session::flash('success','Project updated successfully');
           }else {
             Session::flash('success','Project succesvol bijgewerkt');
           }

        return response()->json([
            'message' => 'success',
            'status'  => 1
        ], 200);
    }

    private function workingDay($day)
    {
        if($day->mon) return 'mon';
        if($day->tue) return 'tue';
        if($day->wed) return 'wed';
        if($day->thu) return 'thu';
        if($day->fri) return 'fri';
        if($day->sat) return 'sat';
        if($day->sun) return 'sun';
    }

    public function getDetails(){

      //return $language;
      $floors    = Floor::where('company_id', '=', Auth::id())->select('name','id')->orderBy('name', 'asc')->get();
      $areas     = Area::where('company_id', '=', Auth::id())->select('name','id')->orderBy('name', 'asc')->get();
      $customers = Customer::where('company_id', '=', Auth::id())
                           ->orderBy('name', 'asc')->get();

      $elements  = Element::where('company_id', '=', Auth::id())->select('id', 'name')->orderBy('name', 'asc')->get();

      $tasks     = Task::orderBy('name', 'asc')->get();
      $comp_id   = Auth::user()->id;

      $supervisor_role = Role::select('id')->where('name','=','supervisor')->first();
      $supervisors     = User::select('name','id')
                              ->where('role_id','=',$supervisor_role->id)
                              ->where('company_id','=',$comp_id)
                              ->where('status','=',1)
                              ->orderBy('name', 'asc')
                              ->get();

      $insp_perm_id = Permission::select('id')
                                 ->where('name','=','give feedback')
                                 ->first();

      $inspectors = DB::table('users')
      ->join('users_permissions','users_permissions.user_id','=','users.id')
      ->where('users_permissions.permission_id','=',$insp_perm_id->id)
      ->where('users.company_id', '=', $comp_id)
      ->where('users.status','=',1)
      ->select('users.name','users.id')
      ->get();

      $role = Role::select('id')
                  ->where('name','=','user')
                  ->first();

      $workers = User::select('name','id', 'employee_code')
                      ->where('role_id','=',$role->id)
                      ->where('company_id','=',$comp_id)
                      ->where('status','=',1)
                      ->orderBy('name', 'asc')
                      ->get();

      return response() -> json([
          'data' => [
              'floors' => $floors,
              'areas'  => $areas,
              'customers' => $customers,
              'elements' => $elements,
              'tasks' => $tasks,
              'workers' => $workers,
              'supervisors' => $supervisors,
              'inspectors' => $inspectors,
          ]
      ], 200);
    }//getDetails

    public function addProject(Request $request){

        // return $request->jobs;

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'customer_id' => 'required',
            'supervisor_id' => 'required',
            'phone' => 'required|',
            //'address' => 'required|max:255',
            //'city' => 'required|max:255',
            'country' => 'required|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            //'houseNumber' => 'required',
            //'postcode' => ['required', 'regex:/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i'],
        ],[
            'phone.regex' => 'Phone Number Must be of Valid format eg: (+31xxxxxxxxx).'
        ]);

        //return Auth::id();

        $project = new Project;


        $project->name           = $request->name;
        $project->description    = $request->description;
        $project->slug           = Str::slug($project->name) . '-' . time();
        $project->phone          = $request->phone;
        $project->company_id     = Auth::id();
        $project->customer_id    = $request->customer_id['id'];
        $project->supervisor_id  = $request->supervisor_id;
        $project->inspector_id   = $request->inspector_id;
        $project->address        = $request->address;
        $project->city           = $request->city;
        $project->zipcode        = $request->zipcode;
        $project->postcode       = $request->postcode;
        $project->houseNumber    = $request->houseNumber;
        $project->country        = $request->country;
        $project->fax            = $request->fax;
        $project->notes          = $request->notes;
        $project->weekcard       = $request->weekcard;
        $project->start_date     = $request->start_date;
        $project->end_date       = $request->end_date;
        $project->break          = $request->break;
        $project->code           = $request->code;
        $project->created_at     = carbon::now();
        $project->updated_at     = carbon::now();

        //return $project;
        $project->save();

        foreach ($request->locations as $key => $location) {
            $loc             = new Location;
            $loc->name       = $location['name'];
            $loc->latitude   = $location['latitude'];
            $loc->longitude  = $location['longitude'];
            $loc->project_id = $project->id;
            $loc->created_at = carbon::now();
            $loc->updated_at = carbon::now();
            $loc->save();
        }

        $distinct_floors = [];
        $jobs = [];
        foreach ($request->jobs as $key => $job) {

            $loc_name = $job['location']['name'];
            $loc_lat = $job['location']['latitude'];
            $loc_long = $job['location']['longitude'];

            $location = Location::where('name','=',$loc_name)
                              ->where('latitude','=',$loc_lat)
                              ->where('longitude','=',$loc_long)
                              ->first();

            $id = $job['floor_id'];
            if (in_array($id, $distinct_floors))
              {
               $job_id          = $jobs[$id];
               $day             = new Day;
               $day->type       = $job['type'];
               $day->task_id    = $job['task_id'];
               $day->element_id = $job['element_id'];
               $day->user_id    = $job['worker_id'];
               $day->job_id     = $job_id;
               $day->area_id    = $job['area_id'];
               $day->location_id    = $location->id;
               $day->project_id = $project->id;
               if ($job['type'] == 'daily') {
                   $day->mon           = $job['mon'] ? 1 : 0;
                   $day->tue           = $job['tue'] ? 1 : 0;
                   $day->wed           = $job['wed'] ? 1 : 0;
                   $day->thu           = $job['thu'] ? 1 : 0;
                   $day->fri           = $job['fri'] ? 1 : 0;
                   $day->sat           = $job['sat'] ? 1 : 0;
                   $day->sun           = $job['sun'] ? 1 : 0;
                   $day->mon           = $job['mon'] ? 1 : 0;
               } else {
                   $day->mon      = 0;
                   $day->tue      = 0;
                   $day->wed      = 0;
                   $day->thu      = 0;
                   $day->fri      = 0;
                   $day->sat      = 0;
                   $day->sun      = 0;
                   $day->week_number = json_encode($job['week_number']);
               }
               $day->save();
              }
            else
              {// create new job first then use that id in new days record
               $new_job             = new Job;
               $new_job->floor_id   = $id;
               $new_job->project_id = $project->id ;
               $new_job->save();

               $element_id = $job['element_id'];
               $task_id = $job['task_id'];

               $day = new Day;
               $day->type           = $job['type'];
               //$day->task_id        = $job['task_id'];
               //$day->element_id     = $job['element_id'];
               //$day->floor_types_id = $job['element_type_id'];
               if ($element_id && Element::where('id', $element_id)->exists()) {
                    $day->element_id = $element_id;
                  } else {
                    // create a new element record
                    $element = new Element;
                    // set the element properties
                      $element->id = $element_id;
                      if (App::getLocale() == "en") {
                      $element->name = $job['element_name'];
                      $element->company_id =  Auth::id();
                      //$element->name = null;
                      } else {
                      $element->name = $job['element_name'];
                      //$element->name = null;
                      }
                      $element->save();
                      $day->element_id = $element->id;
                }
              //do the same for task
              if ($task_id && Task::where('id', $task_id)->exists()) {
                $day->task_id = $task_id;
              } else {
                // create a new task record
                $task = new Task;
                // set the task properties
                $task->id = $task_id;
                if (App::getLocale() == "en") {
                  $task->name = $job['task_name'];
                  //$task->name = null;
                  $task->description = null;
                  $task->slug = Str::slug($task->name) . '-' . time();
                } else {
                  $task->name = $job['task_name'];
                }
                $task->element_id = $day->element_id;
                $task->save();
                $day->task_id = $task->id;
              }


               $day->user_id    = $job['worker_id'];
               $day->job_id     = $new_job->id;
               $day->area_id    = $job['area_id'];
               $day->location_id    = $location->id;
               $day->project_id = $project->id;
               if ($job['type'] == 'daily') {
                   $day->mon           = $job['mon'] ? 1 : 0;
                   $day->tue           = $job['tue'] ? 1 : 0;
                   $day->wed           = $job['wed'] ? 1 : 0;
                   $day->thu           = $job['thu'] ? 1 : 0;
                   $day->fri           = $job['fri'] ? 1 : 0;
                   $day->sat           = $job['sat'] ? 1 : 0;
                   $day->sun           = $job['sun'] ? 1 : 0;
                   $day->mon           = $job['mon'] ? 1 : 0;
               } else {
                   $day->mon      = 0;
                   $day->tue      = 0;
                   $day->wed      = 0;
                   $day->thu      = 0;
                   $day->fri      = 0;
                   $day->sat      = 0;
                   $day->sun      = 0;
                   $day->week_number = json_encode($job['week_number']);
               }
               $day->save();
               $jobs[$id]=$new_job->id;
               $distinct_floors[$key] = $id;
              }
        }
        if (App::getLocale() == "en") {
             Session::flash('success','Project created successfully');
           }else {
             Session::flash('success','Project succesvol gemaakt');
           }

        return response()->json([
                        'message' => 'success',
                        'status'  => 1
                    ], 200);
    }//addProject ends here


    public function getFloorAreaJobs(Request $request)
    {
        $job = Job::select('id')
                    ->where('project_id','=',$request->project_id)
                    ->where('floor_id','=',$request->floor_id)
                    ->first();

        return response()->json([
                        'data' => DayResource::collection(Day::where('job_id','=',$job->id)->where('area_id','=',$request->area_id)->get()),
                        'status'  => 1,
                        'job_id'  => $job->id,
                    ], 200);

    }

    public function projectJobPdf($project_id, $job_id,$area_id)
    {
        $job = Job::findOrFail($job_id);
        $floor_id = $job->floor_id;
        $floor = Floor::findOrFail($floor_id);
        $floor_name = $floor->name;
        $project = Project::findOrFail($project_id);
        $days = Day::where('job_id','=',$job_id)->where('area_id','=',$area_id)->get();

        $pdf = PDF::loadView('Company_Admin.project.downloadPdf', compact('project','days','floor_name'))->setPaper('a4', 'landscape');

        return $pdf->download('projectDetail.pdf');
    }

    public function projectAllJobPdf($project_id)
    {
        $project = Project::find($project_id);
        // $project = Project::where('projects.id','=',$project_id)->first();
        // dd($project->jobs);
        $jobs = $project->jobs;
        $pdf = PDF::loadView('Company_Admin.project.downloadAllJobPdf',compact('project','jobs'))->setPaper('a4', 'landscape');

        return $pdf->download('projectDetail.pdf');
    }

    public function getFloorAreas(Request $request)
    {
        $job = Job::where('project_id','=',$request->project_id)
                    ->where('floor_id','=',$request->floor_id)
                    ->first();

        $area_ids = [];
        $days = Day::select('area_id')
                    ->where('job_id',$job->id)
                    ->distinct()
                    ->get();

        $area_ids = Arr::pluck($days, 'area_id');
        $areas = Area::select('id','name')->whereIn('id',$area_ids)->get();

        return response()->json([
            'status' => 1,
            'areas'  => $areas,
        ],200);
    }

}

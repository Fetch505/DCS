<?php

namespace App\Http\Controllers\CompanyAdmin;

use Auth;
use DB;
use PDF;
use App\Models\Customer;
use App\Models\FloorType;
use App\Models\RoomTypes;
use App\Models\Area;
use App\Models\Role;
use App\Models\User;
use App\Models\Task;
use App\Models\Element;
use App\Models\AreaEstimate;
use App\Models\EmployeeGroup;
use App\Models\CorrectionStandard;
use App\Models\ProjectCostEstimate;
use App\Models\RoomTypesFloorType;
use App\Models\SpaceStateCalculation;
use App\Models\AreaEstimateSelectedTasks;
use App\Models\AreaEstimateSelectedElements;
use App\Models\ProjectCostSupervisionTeam;
use App\Models\ProjectCostProductionTeam;
use App\Http\Resources\AreaEstimateResource;
use App\Http\Resources\SelectedProductionTeamResource;
use App\Http\Resources\SelectedSupervisorsTeamResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ProjectCostEstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $projects = ProjectCostEstimate::where('company_id', '=', Auth::id())->get();
      return view('Company_Admin.ProjectCostEstimate.index')
                  ->withProjects($projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('Company_Admin.ProjectCostEstimate.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'project_name' => 'required|string',
            'client_name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'contact_person1' => 'required|string',
            'contact_person2' => 'required|string',
            'phone' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $newProject = new ProjectCostEstimate;
        $newProject->project_name = $request->project_name;
        $newProject->client_name = $request->client_name;
        $newProject->slug = Str::slug($newProject->project_name) . '-' . time();
        $newProject->email = $request->email;
        $newProject->address = $request->address;
        $newProject->company_id = Auth::id();
        $newProject->phone = $request->phone;
        $newProject->contact_person1 = $request->contact_person1;
        $newProject->contact_person2 = $request->contact_person2;
        $newProject->start_date = $request->start_date;
        $newProject->end_date = $request->end_date;
        $newProject->rate = $request->rate;
        $newProject->total_sq_meter_per_hour = $request->total_sq_meter_per_hour;
        $newProject->total_hours_a_year = $request->total_hours_a_year;
        $newProject->total_hours_a_day = $request->total_hours_a_day;
        $newProject->contract_sum_a_year = $request->contract_sum_a_year;
        $newProject->save();
// return $request->normTable;
        foreach ($request->normTable as $key => $entry) {
            // return $entry['comment']['comments'];
            $areaEstimate = new AreaEstimate;
            $areaEstimate->floor_type = $entry['floor_type']['name'];
            $areaEstimate->room_type = $entry['room_type']['name'];
            $areaEstimate->floor_type_id = $entry['floor_type']['id'];
            $areaEstimate->room_type_id = $entry['room_type']['id'];
            $areaEstimate->comment = ($entry['comment'] == 'Geen opmerkingen')? 'Geen opmerkingen' : $entry['comment']['comments'];
            $areaEstimate->frequency = $entry['frequency'];
            $areaEstimate->factor = $entry['factor'];
            $areaEstimate->sq_meter_area_per_hour = $entry['sq_m_area_hour'];
            $areaEstimate->project_cost_estimates_id = $newProject->id;
            $areaEstimate->save();

            foreach ($entry['elements_table'] as $key => $value) {
                $elem = new AreaEstimateSelectedElements;
                $elem->frequency = $value['element_frequency'];
                $elem->element_id = $value['element_object']['id'];
                $elem->area_estimate_id = $areaEstimate->id;
                $elem->save();
            }

            foreach ($entry['tasks_table'] as $key => $value) {
                $task = new AreaEstimateSelectedTasks;
                $task->frequency = $value['task_frequency'];
                $task->task_id = $value['task_object']['id'];
                $task->area_estimate_id = $areaEstimate->id;
                $task->save();
            }
        }

        foreach ($request->spaceStateTable as $key => $entry) {
            $spaceState = new SpaceStateCalculation;
            $spaceState->sq_meter = $entry['sq_meter'];
            $spaceState->norm = $entry['norm'];
            $spaceState->hours_per_turn = $entry['hours_per_turn'];
            $spaceState->frequency = $entry['frequency'];
            $spaceState->hours_a_year = $entry['hours_a_year'];
            $spaceState->rate = $entry['rate'];
            $spaceState->amount = $entry['amount'];
            $spaceState->project_cost_estimates_id = $newProject->id;
            $spaceState->save();
        }

        foreach ($request->prd_hr_mon_fri_Table as $key => $entry) {
            $prdTeam = new ProjectCostProductionTeam;
            $prdTeam->group_name = $entry['group_name'];
            $prdTeam->group_id = $entry['group_detail']['id'];
            $prdTeam->hourly_rate = $entry['hourly_rate'];
            $prdTeam->percentage = $entry['percentage'];
            $prdTeam->project_cost_estimates_id = $newProject->id;
            $prdTeam->save();
        }

        foreach ($request->drt_sup_hr_mon_fri_Table as $key => $entry) {
            $supTeam = new ProjectCostSupervisionTeam;
            $supTeam->group_name = $entry['group_name'];
            $supTeam->group_id = $entry['group_detail']['id'];
            $supTeam->hourly_rate = $entry['hourly_rate'];
            $supTeam->percentage = $entry['percentage'];
            $supTeam->project_cost_estimates_id = $newProject->id;
            $supTeam->save();
        }

        return response()->json([
                'message' => 'success',
                'status'  => 1
            ], 200);
        // return response()->json([
        //     'status' => true,
        //     'errors' =>false,
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectCostEstimate  $projectCostEstimate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $projectCostEstimate = ProjectCostEstimate::findorFail($id);
      $areaEstimateTable = AreaEstimate::where('project_cost_estimates_id','=',$id)->get();
      $spaceStateTable = SpaceStateCalculation::where('project_cost_estimates_id','=',$id)->get();

      return view('Company_Admin.ProjectCostEstimate.view')
                  ->withProjectCostEstimate($projectCostEstimate)
                  ->withAreaEstimateTable($areaEstimateTable)
                  ->withSpaceStateTable($spaceStateTable);
    }

    public function downloadEstimatePDF($id)
    {
      $projectCostEstimate = ProjectCostEstimate::findorFail($id);
      $areaEstimateTable = AreaEstimate::where('project_cost_estimates_id','=',$id)->get();
      $spaceStateTable = SpaceStateCalculation::where('project_cost_estimates_id','=',$id)->get();

      $pdf = PDF::loadView('Company_Admin.ProjectCostEstimate.pdf', compact('projectCostEstimate','areaEstimateTable','spaceStateTable'))->setPaper('a4', 'portrait');

      return $pdf->download('CostEstimate.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectCostEstimate  $projectCostEstimate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projectCostEstimate = ProjectCostEstimate::findorFail($id);

        $drtSupTable =  SelectedSupervisorsTeamResource::collection($projectCostEstimate->supTeam);
        $prodTable =  SelectedProductionTeamResource::collection($projectCostEstimate->prodTeam);

        $supTeam = $projectCostEstimate->supTeam;
        return view('Company_Admin.ProjectCostEstimate.edit')
                    ->withProjectCostEstimate($projectCostEstimate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectCostEstimate  $projectCostEstimate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $this->validate($request,[
            'project_name' => 'required|string',
            'client_name' => 'required|string',
            'client_type' => 'required',
            'email' => 'required|email',
            'address' => 'required|string',
            'contact_person1' => 'required|string',
            'contact_person2' => 'required|string',
            'phone' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $projectCostEstimate = ProjectCostEstimate::findorFail($id);
        $projectCostEstimate->project_name        = $request->project_name;
        $projectCostEstimate->client_name         = $request->client_name;
        $projectCostEstimate->email               = $request->email;
        $projectCostEstimate->address             = $request->address;
        $projectCostEstimate->phone               = $request->phone;
        $projectCostEstimate->contact_person1     = $request->contact_person1;
        $projectCostEstimate->contact_person2     = $request->contact_person2;
        $projectCostEstimate->start_date          = $request->start_date;
        $projectCostEstimate->end_date                = $request->end_date;
        $projectCostEstimate->rate                    = $request->rate;
        $projectCostEstimate->total_sq_meter_per_hour = $request->total_sq_meter_per_hour;
        $projectCostEstimate->total_hours_a_year      = $request->total_hours_a_year;
        $projectCostEstimate->total_hours_a_day       = $request->total_hours_a_day;
        $projectCostEstimate->contract_sum_a_year     = $request->contract_sum_a_year;
        $projectCostEstimate->save();

        //first delete all areaestiamte linked tasks and elements
        foreach ($projectCostEstimate->areaestimates as $area) {
            AreaEstimateSelectedElements::where('area_estimate_id','=',$area->id)->delete();
            AreaEstimateSelectedTasks::where('area_estimate_id','=',$area->id)->delete();
        }
        //now delete area estiamte of this project
        AreaEstimate::where('project_cost_estimates_id','=',$projectCostEstimate->id)->delete();

        //now save new area estiamtes and selected tasks and elements
        foreach ($request->areaEstimateTable as $key => $entry) {
            // return $entry;
            $areaEstimate = new AreaEstimate;
            $areaEstimate->floor_type = $entry['floor_type'];
            $areaEstimate->room_type = $entry['room_type'];
            $areaEstimate->floor_type_id = $entry['floor_type_id'];
            $areaEstimate->room_type_id = $entry['room_type_id'];
            $areaEstimate->comment = $entry['comment'];
            $areaEstimate->frequency = $entry['frequency'];
            $areaEstimate->factor = $entry['factor'];
            $areaEstimate->sq_meter_area_per_hour = $entry['sq_meter_area_per_hour'];
            $areaEstimate->project_cost_estimates_id = $projectCostEstimate->id;
            $areaEstimate->save();

            // return $entry['elements_table'];
            foreach ($entry['elements'] as $key => $value) {
                // return $value['id'];
                $elem = new AreaEstimateSelectedElements;
                $elem->frequency = $value['element_frequency'];
                $elem->element_id = $value['id'];
                $elem->area_estimate_id = $areaEstimate->id;
                $elem->save();
            }

            foreach ($entry['tasks'] as $key => $value) {
                $task = new AreaEstimateSelectedTasks;
                $task->frequency = $value['task_frequency'];
                $task->task_id = $value['id'];
                $task->area_estimate_id = $areaEstimate->id;
                $task->save();
            }
        }

        SpaceStateCalculation::where('project_cost_estimates_id','=',$projectCostEstimate->id)->delete();

        ProjectCostProductionTeam::where('project_cost_estimates_id','=',$projectCostEstimate->id)->delete();

        ProjectCostSupervisionTeam::where('project_cost_estimates_id','=',$projectCostEstimate->id)->delete();

        foreach ($request->space_State_Table as $key => $entry) {
            $spaceState = new SpaceStateCalculation;
            $spaceState->sq_meter = $entry['sq_meter'];
            $spaceState->norm = $entry['norm'];
            $spaceState->hours_per_turn = $entry['hours_per_turn'];
            $spaceState->frequency = $entry['frequency'];
            $spaceState->hours_a_year = $entry['hours_a_year'];
            $spaceState->rate = $entry['rate'];
            $spaceState->amount = $entry['amount'];
            $spaceState->project_cost_estimates_id = $projectCostEstimate->id;
            $spaceState->save();
        }

        foreach ($request->prd_hr_mon_fri_Table as $key => $entry) {
            $prdTeam = new ProjectCostProductionTeam;
            $prdTeam->group_name = $entry['group_name'];
            $prdTeam->group_id = ($entry['group_id']) ? $entry['group_id'] : $entry['group_detail']['id'];
            // $prdTeam->group_id = $entry['group_detail']['id'];
            $prdTeam->hourly_rate = $entry['hourly_rate'];
            $prdTeam->percentage = $entry['percentage'];
            $prdTeam->project_cost_estimates_id = $projectCostEstimate->id;
            $prdTeam->save();
        }

        foreach ($request->drt_sup_hr_mon_fri_Table as $key => $entry) {
            $supTeam = new ProjectCostSupervisionTeam;
            $supTeam->group_name = $entry['group_name'];
            $supTeam->group_id = ($entry['group_id']) ? $entry['group_id'] : $entry['group_detail']['id'];
            // $supTeam->group_id = $entry['group_detail']['id'];
            $supTeam->hourly_rate = $entry['hourly_rate'];
            $supTeam->percentage = $entry['percentage'];
            $supTeam->project_cost_estimates_id = $projectCostEstimate->id;
            $supTeam->save();
        }

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectCostEstimate  $projectCostEstimate
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {

    }

    public function deleteEstimate($id)
    {
        $projectCostEstimate = ProjectCostEstimate::find($id);
        // $projectCostEstimate = ProjectCostEstimate::where('id','=',$id)->delete();
        foreach ($projectCostEstimate->areaestimates as $key => $area) {
            AreaEstimateSelectedElements::where('area_estimate_id','=',$area->id)->delete();
            AreaEstimateSelectedTasks::where('area_estimate_id','=',$area->id)->delete();
            $area->delete();
        }
        ProjectCostProductionTeam::where('project_cost_estimates_id','=',$id)->delete();
        ProjectCostSupervisionTeam::where('project_cost_estimates_id','=',$id)->delete();
        SpaceStateCalculation::where('project_cost_estimates_id','=',$id)->delete();
        $projectCostEstimate->delete();
        return redirect()->route('projectcostestimate.index');
    }

    public function customerList()
    {
        $id = Auth::id();
        $customer_role = Role::where('name','=','customer')->first();
        $customers = User::where('company_id', '=', $id)
                         ->where('role_id', '=', $customer_role->id)
                         ->get();
        $floor_types = FloorType::orderBy('name', 'asc')->get();
        $room_types = RoomTypes::orderBy('name', 'asc')->get();
        $tasks = Task::select('id','name')->orderBy('name', 'asc')->get();
        $worker_groups = EmployeeGroup::orderBy('name', 'asc')->get();
        $elements = Element::orderBy('name', 'asc')->get();
        return response()->json([
            'customers' => $customers,
            'floor_types' => $floor_types,
            'room_types' => $room_types,
            'tasks' => $tasks,
            'elements' => $elements,
            'worker_groups' => $worker_groups,
        ]);
    }// customerList ends here

    public function correctionStand(Request $request)
    {
      // return $request->all();
        $floor_type = $request->floor_type;
        $room_type = $request->room_type;
        $floor_type_id = $request->floor_type_id;
        $room_type_id = $request->room_type_id;
        $comments = $request->comments;
        $frequency = $request->frequency;
        $standardCalculation = $request->standardCalcultaion;

        if ($standardCalculation) {
            $stndard_percent = false;
        }
        else if($floor_type == 'carpet'){
             $stndard_percent = CorrectionStandard::where('floor_type','=','carpet')
                                ->where('frequency','=',$frequency)
                                ->first();

         }else{
             if($room_type == 'sanitary' && $floor_type != 'lino'){
                 $stndard_percent = CorrectionStandard::where('floor_type','!=','lino')
                                    ->where('room_type','=','sanitary')
                                    ->where('frequency','=',$frequency)
                                    ->first();

             }else {
                 $stndard_percent = CorrectionStandard::where('floor_type','!=','carpet')
                                    ->where('frequency','=',$frequency)
                                    ->first();

             }//
         }//else ends here

         $standard_freq_area = RoomTypesFloorType::where('room_types_id','=',$room_type_id)
                                                 ->where('floor_type_id','=',$floor_type_id)
                                                 ->where('comments','=',$comments)
                                                 ->first();
      return response()->json([
          'stndard_percent' => $stndard_percent,
          'standard_freq_area' => $standard_freq_area,
          'room_types_id' => $room_type_id,
          'floor_type_id' => $floor_type_id,
          'comments' => $comments,
      ]);
    }

    public function commentsList($id)
    {
        $comments = DB::table('floor_type_room_types')->select('comments')
                                        ->where('room_types_id','=',$id)
                                        ->distinct('comments')
                                        ->get();

        return response()->json([
            'comments' => $comments,
        ]);
    }

    public function selectedRoomTypes($id)
    {
        // $roomTypes = RoomTypesFloorType::where('floor_type_id','=',$id)
        //                                 ->get();
        $roomTypes = DB::table('floor_type_room_types')
                ->join('room_types','room_types.id','=','floor_type_room_types.room_types_id')
                ->where('floor_type_room_types.floor_type_id','=',$id)
                ->select('room_types.*')
                ->orderBy('room_types.name', 'asc')
                ->get();

        return response()->json([
            'roomTypes' => $roomTypes,
        ]);
    }

    public function getProjectCostEstimateDetail($id)
    {

      $project = ProjectCostEstimate::findorFail($id);
      $comp_id = Auth::id();
      $customer_role = Role::where('name','=','customer')->first();
      $customers = User::where('company_id', '=', $comp_id)
                       ->where('role_id', '=', $customer_role->id)
                       ->get();
      // $customers = Customer::where('company_id', '=', Auth::id())->get();
      $floor_types = FloorType::orderBy('name', 'asc')->get();
      $room_types = RoomTypes::orderBy('name', 'asc')->get();
      $tasks = Task::select('id','name')->orderBy('name', 'asc')->get();
      $worker_groups = EmployeeGroup::orderBy('name', 'asc')->get();
      $elements = Element::orderBy('name', 'asc')->get();
      $areaEstimate = $project->areaestimates;
      $drtSupTable = SelectedSupervisorsTeamResource::collection($project->supTeam);
      $prodTable = SelectedProductionTeamResource::collection($project->prodTeam);

      $areaEstimate = AreaEstimateResource::collection($project->areaestimates);
      $spaceStateTable = SpaceStateCalculation::where('project_cost_estimates_id','=',$id)->get();

      return response()->json([
          'project' => $project,
          'areaEstimateTable' => $areaEstimate,
          'customers' => $customers,
          'floor_types' => $floor_types,
          'room_types' => $room_types,
          'tasks' => $tasks,
          'elements' => $elements,
          'worker_groups' => $worker_groups,
          'spaceStateTable' => $spaceStateTable,
          'drtSupTable' => $drtSupTable,
          'prodTable' => $prodTable,

      ]);
    }

    public function getAreaTaskElementTables($id,$area_id){

        $elementsTable= DB::table('area_estimate_selected_elements')
            ->join('elements', 'area_estimate_selected_elements.element_id',
            '=','elements.id')
            ->where('area_estimate_selected_elements.area_estimate_id'
              ,'=',$id)
              ->select('elements.name as element_name','area_estimate_selected_elements.frequency as element_frequency','area_estimate_selected_elements.id as sel_element_table_id','elements.id')
              ->get();

        $tasksTable= DB::table('area_estimate_selected_tasks')
            ->join('tasks', 'area_estimate_selected_tasks.task_id',
            '=','tasks.id')
            ->where('area_estimate_selected_tasks.area_estimate_id'
              ,'=',$id)
              ->select('tasks.name as task_name','area_estimate_selected_tasks.frequency as task_frequency','area_estimate_selected_tasks.id as sel_task_table_id','tasks.id')
              ->get();

              $comments = DB::table('floor_type_room_types')
                                ->select('comments')
                                ->where('room_types_id','=',$area_id)
                                ->distinct('comments')
                                ->get();
        return response()->json([
            'elements' => $elementsTable,
            'tasks' => $tasksTable,
            'comments' => $comments,
        ]);
    } // getAreaTaskElementTables ends here
}

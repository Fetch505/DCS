<?php

namespace App\Http\Controllers\CompanyAdmin;

use DB;
use App;
use Hash;
use Auth;
use Session;
use Response;
use App\Models\Area;
use App\Models\Task;
use App\Models\Role;
use App\Models\User;
use App\Models\Project;
use App\Models\Material;
use App\Models\Customer;
use App\Models\Element;
use App\Models\FloorType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$tasks = Task::all();
        $company_id = auth()->id();

        $tasks = Task::whereHas('element', function($query) use ($company_id) {
            $query->where('company_id', $company_id);
        })->with('element')->get();

        //$tasks = Task::with('element')->get();
        //dd($tasks);
        // dd($tasks[0]->area->project->name);
        return view('Company_Admin.task.index')->withTasks($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company_id = auth()->id();
        //dd($company_id);
        $elements = Element::where('company_id', $company_id)->get();
        return view('Company_Admin.task.add',['elements' => $elements]);
    }

    public function alltasks()
    {
      $tasks = Task::withTrashed()->get();
      return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'name' => 'required|max:255',
          //'name_eng' => 'required|max:255',
          'description' => 'required|max:255',
          //'description_eng' => 'required|max:255',
          'element_id' => 'required|max:255',
          ]);
          // dd($request->materials);

          $task = new Task;
          $task->name = $request->name;
          //$task->name_eng = $request->name_eng;
          $task->description = $request->description;
          //$task->description_eng = $request->description_eng;
          $task->element_id = $request->element_id;
          $task->slug = Str::slug($task->name) . '-' . time();
          $task->save();

          if (App::getLocale() == "en") {
            Session::flash('success','New task created successfully');
          }else {
            Session::flash('success','Nieuwe taak gemaakt');
          }
          return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {

      return view('Company_Admin.task.view')->withTask($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $elements = Element::all();
        return view('Company_Admin.task.edit', compact('elements','task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
// dd($request->all());
        $request->validate([
          'name' => 'required|max:255',
          //'name_eng' => 'required|max:255',
          'description' => 'required|max:255',
          //'description_eng' => 'required|max:255',
          'element_id' => 'required|max:255',
          ]);

          $task->name = $request->name;
          //$task->name_eng = $request->name_eng;
          $task->description = $request->description;
          //$task->description_eng = $request->description_eng;
          $task->element_id = $request->element_id;
          $task->save();

          if (App::getLocale() == "en") {
            Session::flash('success','Task info updated successfully');
          }else {
            Session::flash('success','Taak succesvol bijgewerkt');
          }
          return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    public function deleteRecord(Task $task)
    {
      $task->delete();
      if (App::getLocale() == "en") {
        Session::flash('success','Task deleted successfully');
      }else {
        Session::flash('success','Taak succesvol verwijderd');
      }
      return redirect()->route('task.index');
    }

    public function getProjects($id)
    {//get projects of specific customer
        $projects = Project::select('name','id')->where('customer_id','=',$id)->get();
        return Response::json($projects);
    }

    public function getAreas($id)
    {//get projects of specific customer
        $areas = Area::select('name','id')->where('project_id','=',$id)->get();
        return Response::json($areas);
    }

}

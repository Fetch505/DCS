<?php

namespace App\Http\Controllers\CustomerAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Project;
use Auth;

class CustomerAdmin extends Controller
{
    public function myProjects()
    {

      $user_id = Auth::user()->id;
      $customer = Customer::where('user_id','=',$user_id)->first();
      $projects = Project::where('customer_id','=',$customer->id)->get();
      // dd($projects[0]->areas[0]->tasks->count());
      // dd($projects);
      return view('Customer.projects.index')->withProjects($projects);
    }

    public function projectDetail(Project $project)
    {
      return view('Customer.projects.view')->withProject($project);
    }


    public function myTasks()
    {

    }
}

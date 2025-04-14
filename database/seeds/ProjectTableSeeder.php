<?php

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $project = new Project;
      $project->name = "Clean It";
      $project->description = "This is our first project in Karachi";
      $project->slug = Str::slug($project->name) . '-' . time();
      $project->address = "Peter Streets, PK";
      $project->customer_id = 2;
      $project->company_id = 2;
      $project->customer_employee_id = 9;
      $project->supervisor_id = 5;
      $project->city = "Karachi";
      $project->zipcode = "aas32";
      $project->phone = "+926548864";
      $project->total_time = "1 hours 30 minutes";
      $project->save();

      $project = new Project;
      $project->name = "New Tower";
      $project->description = "This is our first project in Dubai";
      $project->slug = Str::slug($project->name) . '-' . time();
      $project->address = "Peter Streets, PK";
      $project->customer_id = 2;
      $project->company_id = 2;
      $project->customer_employee_id = 9;
      $project->supervisor_id = 5;
      $project->city = "Karachi";
      $project->zipcode = "aas32";
      $project->phone = "+926548864";
      $project->total_time = "2 hours 30 minutes";
      $project->save();

      $project = new Project;
      $project->name = "Clean and Wash";
      $project->description = "This is our first project in Lahore";
      $project->slug = Str::slug($project->name) . '-' . time();
      $project->address = "Peter Streets, PK";
      $project->customer_id = 2;
      $project->company_id = 2;
      $project->customer_employee_id = 9;
      $project->supervisor_id = 5;
      $project->city = "Karachi";
      $project->zipcode = "aas32";
      $project->phone = "+926548864";
      $project->total_time = "6 hours 30 minutes";
      $project->save();

      $project = new Project;
      $project->name = "Santander Bank Cleaning";
      $project->description = "Cleaning bank floors";
      $project->slug = Str::slug($project->name) . '-' . time();
      $project->address = "Main Boulevard, Model Town, Seattle, US";
      $project->customer_id = 2;
      $project->company_id = 11;
      $project->customer_employee_id = 9;
      $project->supervisor_id = 5;
      $project->city = "Karachi";
      $project->zipcode = "aas32";
      $project->phone = "+926548864";
      $project->total_time = "6 hours 30 minutes";
      $project->save();
    }
}

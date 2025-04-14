<?php
use Carbon\Carbon;
use App\Models\ProjectCostEstimate;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProjectCostEstimateTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $project = new ProjectCostEstimate;
        $project->project_name = "Delta Packs";
        $project->client_name = "Tetra Packs";
        $project->slug = Str::slug($project->project_name) . '-' . time();
        $project->address = "Peter Streets, PK";
        $project->phone = "+926548864";
        $project->email = "projcost@gmail.com";
        $project->contact_person1 = "Mr Shaun";
        $project->company_id = 2;
        $project->contact_person2 = "Mr Taylor";
        $project->start_date = Carbon::parse('2019-01-01');
        $project->end_date = Carbon::parse('2019-05-08');
        $project->save();

        $project = new ProjectCostEstimate;
        $project->project_name = "Clean All";
        $project->client_name = "Eggon";
        $project->slug = Str::slug($project->project_name) . '-' . time();
        $project->address = "Peter Streets, PK";
        $project->phone = "+926548864";
        $project->company_id = 2;
        $project->email = "projcost@gmail.com";
        $project->contact_person1 = "Mr Shaun";
        $project->contact_person2 = "Mr Taylor";
        $project->start_date = Carbon::parse('2019-01-01');
        $project->end_date = Carbon::parse('2019-05-08');
        $project->save();

    }
}

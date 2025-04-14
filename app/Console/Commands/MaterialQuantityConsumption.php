<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Material;
use App\Models\Project;

class MaterialQuantityConsumption extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'materials:consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update material quantities based on daily consumption.    ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Get all projects
        $projects = Project::all();

        // Loop through each project
        foreach ($projects as $project) {
            // Get materials attached to the project
            $materials = $project->materials;

            // Loop through each material
            foreach ($materials as $material) {
                // Calculate new quantity
                $newQuantity = $material->pivot->quantity - $material->pivot->consumption_per_day;

                // Ensure quantity doesn't go negative
                if ($newQuantity < 0) {
                    $newQuantity = 0;
                }

                // Update material quantity in the pivot table
                $project->materials()->updateExistingPivot($material->id, ['quantity' => $newQuantity]);
            }
        }

        $this->info('Material consumption updated successfully.');
    }
}

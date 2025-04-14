<?php

use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $task = new Task;
      $task->name = "Wipe down appliances";
      $task->description = "Wipe down appliances on first floor of building 3";
      $task->slug = Str::slug($task->name) . '-' . time();
      $task->save();

      $task = new Task;
      $task->name = "Scrub and disinfect toilets.";
      $task->description = "Scrub and disinfect toilets on first floor of building 3";
      $task->slug = Str::slug($task->name) . '-' . time();
      $task->save();

      $task = new Task;
      $task->name = "Take Out Trash";
      $task->description = "Take Out Trash on first floor of building 3";
      $task->slug = Str::slug($task->name) . '-' . time();
      $task->save();

    }
}

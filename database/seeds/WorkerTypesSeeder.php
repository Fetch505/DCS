<?php

use Illuminate\Database\Seeder;
use App\Models\WorkerType;

class WorkerTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $workerType = new WorkerType;
      $workerType->name = 'Floor polisher';
      $workerType->save();

      $workerType = new WorkerType;
      $workerType->name = 'Vacuum cleaner';
      $workerType->save();


      $workerType = new WorkerType;
      $workerType->name = 'Steam cleaner';
      $workerType->save();


      $workerType = new WorkerType;
      $workerType->name = 'Carpets cleaner';
      $workerType->save();


      $workerType = new WorkerType;
      $workerType->name = 'Window cleaner';
      $workerType->save();

      $workerType = new WorkerType;
      $workerType->name = 'Bathroom cleaner';
      $workerType->save();

      $workerType = new WorkerType;
      $workerType->name = 'House sweeper';
      $workerType->save();

      $workerType = new WorkerType;
      $workerType->name = 'Street sweeper';
      $workerType->save();
    }
}

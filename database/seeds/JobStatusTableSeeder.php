<?php

use Illuminate\Database\Seeder;
use App\Models\JobStatus;

class JobStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $jobStatus = new JobStatus;
      $jobStatus->name = 'Not Started';
      $jobStatus->save();

      $jobStatus = new JobStatus;
      $jobStatus->name = 'Started';
      $jobStatus->save();

      $jobStatus = new JobStatus;
      $jobStatus->name = 'Finished';
      $jobStatus->save();
    }
}

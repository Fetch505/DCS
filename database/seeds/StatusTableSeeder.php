<?php

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $Status = new Status;
      $Status->name = "Pending";
      $Status->save();

      $Status = new Status;
      $Status->name = "Approved";
      $Status->save();

      $Status = new Status;
      $Status->name = "Rejected";
      $Status->save();

      $Status = new Status;
      $Status->name = "Closed";
      $Status->save();
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\Leave;

class LeavesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $leave = new Leave;
      $leave->details = "Hollidays Leave";
      $leave->start_date = "01/08/2019";
      $leave->end_date = "12/08/2019";
      $leave->status_id = 1;
      $leave->leave_type_id = 2;
      $leave->save();

      $leave = new Leave;
      $leave->details = "Sick Leave";
      $leave->start_date = "01/08/2019";
      $leave->status_id = 1;
      $leave->leave_type_id = 1;
      $leave->save();
    }
}

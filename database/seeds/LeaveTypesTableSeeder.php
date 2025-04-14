<?php

use Illuminate\Database\Seeder;
use App\Models\LeaveType;

class LeaveTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leaveType = new LeaveType;
        $leaveType->name = "Sick Leave";
        $leaveType->save();

        $leaveType = new LeaveType;
        $leaveType->name = "Hollidays Leave";
        $leaveType->save();
    }
}

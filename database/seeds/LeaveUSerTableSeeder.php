<?php

use Illuminate\Database\Seeder;
use App\Models\LeaveUser;

class LeaveUSerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leaveUser = new LeaveUser;
        $leaveUser->leave_id = 1;
        $leaveUser->user_id = 3;
        $leaveUser->reports_to_id = 4;
        $leaveUser->save();

        $leaveUser = new LeaveUser;
        $leaveUser->leave_id = 2;
        $leaveUser->user_id = 4;
        $leaveUser->reports_to_id = 3;
        $leaveUser->save();
    }
}

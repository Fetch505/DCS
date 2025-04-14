<?php

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        $role = new Role;
        $role->name = strtolower('SuperAdmin');
        $role->slug = Str::slug($role->name) . '-' . time();
        $role->description = "Master to handle of all the operations inside this app";
        $role->save();

        $role = new Role;
        $role->name = strtolower('admin');
        $role->slug = Str::slug($role->name) . '-' . time();
        $role->description = "Role for company admins";
        $role->save();

        $role = new Role;
        $role->name = strtolower('user');
        $role->slug = Str::slug($role->name) . '-' . time();
        $role->description = "Role for users";
        $role->save();

        $role = new Role;
        $role->name = strtolower('customer');
        $role->slug = Str::slug($role->name) . '-' . time();
        $role->description = "Role for customer";
        $role->save();

        $role = new Role;
        $role->name = strtolower('supervisor');
        $role->slug = Str::slug($role->name) . '-' . time();
        $role->description = "Role for supervisors";
        $role->save();

        $role = new Role;
        $role->name = strtolower('manager');
        $role->slug = Str::slug($role->name) . '-' . time();
        $role->description = "Role for manager";
        $role->save();
    }
}

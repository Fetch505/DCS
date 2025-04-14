<?php

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    public function run()
    {
        $permission1 = new Permission;
        $permission1->name = strtolower("Approve Leaves");
        $permission1->slug = Str::slug($permission1->name) . '-' . time();
        $permission1->save();

        $permission2 = new Permission;
        $permission2->name = strtolower("Give Feedback");
        $permission2->slug = Str::slug($permission2->name) . '-' . time();
        $permission2->save();

        // $permission1 = new Permission;
        // $permission1->name = strtolower("create post");
        // $permission1->slug = Str::slug($permission1->name) . '-' . time();
        // $permission1->save();
        //
        // $permission2 = new Permission;
        // $permission2->name = strtolower("View post");
        // $permission2->slug = Str::slug($permission2->name) . '-' . time();
        // $permission2->save();
        //
        // $permission3 = new Permission;
        // $permission3->name = strtolower("update post");
        // $permission3->slug = Str::slug($permission3->name) . '-' . time();
        // $permission3->save();
        //
        // $permission4 = new Permission;
        // $permission4->name = strtolower("delete post");
        // $permission4->slug = Str::slug($permission4->name) . '-' . time();
        // $permission4->save();
        //
        // $permission5 = new Permission;
        // $permission5->name = strtolower("delete user");
        // $permission5->slug = Str::slug($permission5->name) . '-' . time();
        // $permission5->save();

        // superadmin role has all permissions
        $permission1->roles()->attach(1);
        $permission2->roles()->attach(1);


        // admin role has create and view permission
        $permission1->roles()->attach(2);
        $permission2->roles()->attach(2);

        //suepradmin@gmail.com user has delete user permission
        // $permission5->users()->attach(1);
        $permission1->users()->attach(13);
        $permission2->users()->attach(13);

        $permission2->users()->attach(14);

    }
}

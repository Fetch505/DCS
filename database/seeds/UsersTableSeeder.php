<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $user = new User;//id =1
        $user->name = "Super Admin";
        $user->email = "superadmin@gmail.com";
        $user->role_id = 1;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();

        $user = new User;//id =2
        $user->name = "Company Admin";
        $user->email = "admin@gmail.com";
        $user->role_id = 2;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->allow_leaves =  1;
        $user->save();

        $user = new User;//id =3
        $user->name = "Alexander";
        $user->email = "manager1@gmail.com";
        $user->role_id = 6;
        $user->company_id = 2;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();

        $user = new User;//id =4
        $user->name = "Maxwel";
        $user->email = "manager2@gmail.com";
        $user->role_id = 6;
        $user->company_id = 2;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();

        $user = new User;//id =5
        $user->name = "Haris";
        $user->email = "supervisor1@gmail.com";
        $user->role_id = 5;
        $user->company_id = 2;
        $user->reports_to_id = 3;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();

        $user = new User;//id =6
        $user->name = "Navid";
        $user->email = "supervisor2@gmail.com";
        $user->role_id = 5;
        $user->company_id = 2;
        $user->reports_to_id = 4;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();

        $user = new User;//id =7
        $user->name = "Johnson";
        $user->email = "user1@gmail.com";
        $user->role_id = 3;
        $user->company_id = 2;
        $user->reports_to_id = 5;
        $user->worker_type_id = 1;
        $user->employment_agency_id = 1;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();

        $user = new User;//id =8
        $user->name = "Cameron";
        $user->email = "user2@gmail.com";
        $user->role_id = 3;
        $user->company_id = 2;
        $user->reports_to_id = 5;
        $user->worker_type_id = 2;
        $user->employment_agency_id = 1;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();

        $user = new User;//id =9
        $user->name = "Alex";
        $user->email = "customer1@gmail.com";
        $user->role_id = 4;
        $user->company_id = 2;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();

        $user = new User;//id =10
        $user->name = "Jerry";
        $user->email = "customer2@gmail.com";
        $user->role_id = 4;
        $user->company_id = 2;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();

        $user = new User; //id = 11
        $user->name = "Ibex Global Cleaning Solutions";
        $user->email = "ibex@gmail.com";
        $user->role_id = 2;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->allow_leaves =  1;
        $user->save();

        // manager
        $user = new User; // id = 12
        $user->name = "Afraz Cheema";
        $user->email = "afraz@gmail.com";
        $user->role_id = 6;
        $user->company_id = 11;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();

        // supervisor
        $user = new User; // id = 13
        $user->name = "Hamad Amjad";
        $user->email = "hamad@gmail.com";
        $user->role_id = 5;
        $user->company_id = 11;
        $user->reports_to_id = 12;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();

        // supervisor
        $user = new User; // id = 14
        $user->name = "Muhammad Zohair";
        $user->email = "zohair@gmail.com";
        $user->role_id = 5;
        $user->company_id = 11;
        $user->reports_to_id = 12;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();

        // Worker
        $user = new User; // id = 15
        $user->name = "Maaz Baig";
        $user->email = "maaz@gmail.com";
        $user->role_id = 3;
        $user->company_id = 11;
        $user->reports_to_id = 13;
        $user->worker_type_id = 2;
        $user->employment_agency_id = 3;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();

        // Worker
        $user = new User; // id = 16
        $user->name = "Zohaib Ahmed";
        $user->email = "zohaib@gmail.com";
        $user->role_id = 3;
        $user->company_id = 11;
        $user->reports_to_id = 13;
        $user->worker_type_id = 2;
        $user->employment_agency_id = 3;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();

        // Worker
        $user = new User; // id = 17
        $user->name = "Usman Asghar";
        $user->email = "usman@gmail.com";
        $user->role_id = 3;
        $user->company_id = 11;
        $user->reports_to_id = 13;
        $user->worker_type_id = 2;
        $user->employment_agency_id = 3;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();


        // Worker
        $user = new User; // id = 18
        $user->name = "Muhammad Shoaib";
        $user->email = "shoaib@gmail.com";
        $user->role_id = 3;
        $user->company_id = 11;
        $user->reports_to_id = 14;
        $user->worker_type_id = 2;
        $user->employment_agency_id = 4;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();

        // Worker
        $user = new User; // id = 19
        $user->name = "Muhammad Agha Hassan";
        $user->email = "agha@gmail.com";
        $user->role_id = 3;
        $user->company_id = 11;
        $user->reports_to_id = 14;
        $user->worker_type_id = 2;
        $user->employment_agency_id = 4;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();

        // Worker
        $user = new User; // id = 20
        $user->name = "Muhammad Shaan Masood";
        $user->email = "shaan@gmail.com";
        $user->role_id = 3;
        $user->company_id = 11;
        $user->reports_to_id = 14;
        $user->worker_type_id = 2;
        $user->employment_agency_id = 4;
        $user->slug = Str::slug($user->name) . '-' . time();
        $user->password =  Hash::make(123456);
        $user->save();

    }
}

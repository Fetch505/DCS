<?php

use App\Models\EmployAgency;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class EmployAgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $agency = new EmployAgency;
      $agency->name = "Alpha Group";
      $agency->email = "alpha@gmail.com";
      $agency->address = "Peter Streets, PK";
      $agency->city = "Karachi";
      $agency->zipcode = "aas32";
      $agency->phone = "1234567891234";
      $agency->company_id = 2;
      $agency->slug = Str::slug($agency->name) . '-' . time();
      $agency->save();

      $agency = new EmployAgency;
      $agency->name = "SAAF";
      $agency->email = "saaf@gmail.com";
      $agency->address = "Tarbela, PK";
      $agency->city = "Ghazi";
      $agency->zipcode = "aasas32";
      $agency->phone = "1234567891234";
      $agency->company_id = 2;
      $agency->slug = Str::slug($agency->name) . '-' . time();
      $agency->save();

      $agency = new EmployAgency;
      $agency->name = "DGS Employment Agency";
      $agency->email = "dgs@gmail.com";
      $agency->address = "Aichson Street";
      $agency->city = "Lahore";
      $agency->zipcode = "54000";
      $agency->phone = "+31123456789";
      $agency->company_id = 11;
      $agency->slug = Str::slug($agency->name) . '-' . time();
      $agency->save();

      $agency = new EmployAgency;
      $agency->name = "IPT Worker Provider";
      $agency->email = "ipt@gmail.com";
      $agency->address = "Aichson Street";
      $agency->city = "Lahore";
      $agency->zipcode = "54000";
      $agency->phone = "+31123456789";
      $agency->company_id = 11;
      $agency->slug = Str::slug($agency->name) . '-' . time();
      $agency->save();
    }
}

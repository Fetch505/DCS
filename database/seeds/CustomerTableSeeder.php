<?php

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $customer = new Customer;
      $customer->name = "New Tech";
      $customer->company_id = 2;
      $customer->user_id = 9;
      $customer->mailbox = "MB_1123";
      $customer->mailbox_city = "Karachi";
      $customer->mailbox_zip = "s3dsd3";
      $customer->slug = Str::slug($customer->name) . '-' . time();
      $customer->save();

      $customer = new Customer;
      $customer->name = "ABC Sol";
      $customer->company_id = 2;
      $customer->user_id = 10;
      $customer->mailbox = "MB_85475";
      $customer->mailbox_city = "Lahore";
      $customer->mailbox_zip = "sasa3";
      $customer->slug = Str::slug($customer->name) . '-' . time();
      $customer->save();

    }
}

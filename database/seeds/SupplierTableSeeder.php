<?php

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $supplier = new Supplier;
      $supplier->name = 'Ghani Store';
      $supplier->contact = '+9231234232';
      $supplier->address = 'Main street, Karachi';
      $supplier->email = 'supplier1@gmail.com';
      $supplier->save();

      $supplier = new Supplier;
      $supplier->name = 'Yasir';
      $supplier->contact = '+9231254466';
      $supplier->address = 'Shahbaz town, Lahore';
      $supplier->email = 'supplier2@gmail.com';
      $supplier->save();

      $supplier = new Supplier;
      $supplier->name = 'Safdar';
      $supplier->contact = '+9231234232';
      $supplier->address = 'Main street, Islamabad';
      $supplier->email = 'supplier3@gmail.com';
      $supplier->save();

      $supplier = new Supplier;
      $supplier->name = 'Ali';
      $supplier->contact = '+9231234232';
      $supplier->address = 'China streets, Faisalabad';
      $supplier->email = 'supplier4@gmail.com';
      $supplier->save();
    }
}

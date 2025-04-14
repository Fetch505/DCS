<?php

use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $company = new Company;
      $company->name = strtolower('Alphabets');
      $company->save();

      $company = new Company;
      $company->name = strtolower('NewTech');
      $company->save();

      $company = new Company;
      $company->name = strtolower('Infinite');
      $company->save();

      $company = new Company;
      $company->name = strtolower('Ibex Global Cleaning Solutions');
      $company->save();
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\FloorType;

class FloorTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $floor = new FloorType;
      $floor->name = strtolower('Carpet');
      $floor->standard_meter_sq_hours = '230';
      $floor->save();

      $floor = new FloorType;
      $floor->name = strtolower('Lino');
      $floor->standard_meter_sq_hours = '210';
      $floor->save();

      $floor = new FloorType;
      $floor->name = strtolower('Stone');
      $floor->standard_meter_sq_hours = '210';
      $floor->save();

      $floor = new FloorType;
      $floor->name = strtolower('Stone/wood');
      $floor->standard_meter_sq_hours = '210';
      $floor->save();

    }
}

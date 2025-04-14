<?php

use App\Models\Floor;
use Illuminate\Database\Seeder;

class FloorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $floor = new Floor;
      $floor->name = strtolower('Floor # 1');
      $floor->save();

      $floor = new Floor;
      $floor->name = strtolower('Floor # 2');
      $floor->save();

      $floor = new Floor;
      $floor->name = strtolower('Floor # 3');
      $floor->save();

      $floor = new Floor;
      $floor->name = strtolower('Floor # 4');
      $floor->save();
    }
}

<?php
use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $area = new Area;
      $area->name = strtolower('guest room');
      $area->floor_id = 1;
      $area->save();

      $area = new Area;
      $area->name = strtolower('Meeting Room');
      $area->floor_id = 2;
      $area->save();

      $area = new Area;
      $area->name = strtolower('Staff Room');
      $area->floor_id = 1;
      $area->save();

      $area = new Area;
      $area->name = strtolower('Waiting Room');
      $area->floor_id = 2;
      $area->save();
    }
}

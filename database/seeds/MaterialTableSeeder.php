<?php

use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $material = new Material;
      $material->name = 'Dettol';
      $material->price = '300';
      $material->save();

      $material = new Material;
      $material->name = 'Surf Excel';
      $material->price = '254';
      $material->save();

      $material = new Material;
      $material->name = 'Cleaner';
      $material->price = '800';
      $material->save();

      $material = new Material;
      $material->name = 'Brush';
      $material->price = '645';
      $material->save();
    }
}

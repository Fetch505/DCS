<?php

use App\Models\Element;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ElementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $element = new Element;
      $element->name = "TelePhone";
      $element->save();

      $element = new Element;
      $element->name = "Table";
      $element->save();

      $element = new Element;
      $element->name = "Chair";
      $element->save();

      $element = new Element;
      $element->name = "Lamp";
      $element->save();
    }
}

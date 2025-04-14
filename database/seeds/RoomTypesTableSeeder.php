<?php

use Illuminate\Database\Seeder;
use App\Models\RoomTypes;
class RoomTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roomType = new RoomTypes;
        $roomType->name = strtolower('Treatment room');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Library');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Storage');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Storage/Archive');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Buffet/Bar');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Computer room');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Shower room');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Entrance');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Fitness room');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Cloak room');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Gym + Storage');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Hall');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Kitchen/Pantry');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Dressing room');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Office');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Class room');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Elevator');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Storage');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Reception area');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Practical room');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Front desk');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Repro room');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Restaurant');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Sanitary/Washroom');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Washroom');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Sauna');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Show room');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Therapy/Physio');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Restroom');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Staircase');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Consulting room');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Hallway');
        $roomType->save();

        $roomType = new RoomTypes;
        $roomType->name = strtolower('Rest/Dressing room');
        $roomType->save();

    }
}

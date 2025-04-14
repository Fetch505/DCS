<?php
use App\Models\AreaFloorTypeStandard;
use Illuminate\Database\Seeder;

class AreaFloorTypeStadardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $standard = new AreaFloorTypeStandard; // for treatment room and carpet
        $standard->area_id = 5;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 230;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for treatment room and lino
        $standard->area_id = 5;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 210;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for treatment room and stone
        $standard->area_id = 5;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 210;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Library and carpet
        $standard->area_id = 6;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 500;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Library and lino
        $standard->area_id = 6;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 460;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Library and stone
        $standard->area_id = 6;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 460;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Storage and carpet
        $standard->area_id = 7;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 660;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Storage and lino
        $standard->area_id = 7;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 600;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Storage and stone
        $standard->area_id = 7;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 600;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Storage/Archive and carpet
        $standard->area_id = 8;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 560;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Storage/Archive and lino
        $standard->area_id = 8;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 500;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Storage/Archive and stone
        $standard->area_id = 8;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 500;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Buffet/Bar and carpet
        $standard->area_id = 9;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 180;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Buffet/Bar and lino
        $standard->area_id = 9;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 165;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Buffet/Bar and stone
        $standard->area_id = 9;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 165;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Computer Room and carpet
        $standard->area_id = 10;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 430;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Computer Room and lino
        $standard->area_id = 10;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 390;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Computer Room and stone
        $standard->area_id = 10;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 390;
        $standard->save();

        // $standard = new AreaFloorTypeStandard; // for Shower Room and carpet
        // $standard->area_id = 12;
        // $standard->floor_type_id = 1;
        // $standard->standard_frequency = 255;
        // $standard->standard_meter_sq_hours = 430;
        // $standard->save();

        $standard = new AreaFloorTypeStandard; // for Shower Room and lino
        $standard->area_id = 11;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 120;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Shower Room and stone
        $standard->area_id = 11;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 120;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Entrance and carpet
        $standard->area_id = 12;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 250;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Entrance and lino
        $standard->area_id = 12;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 230;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Entrance and stone
        $standard->area_id = 12;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 230;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Fitnes room and carpet
        $standard->area_id = 13;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 500;
        $standard->comments = 'Without machines';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Fitnes room and lino
        $standard->area_id = 13;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 5425;
        $standard->save();

        // $standard = new AreaFloorTypeStandard; // for Fitnes room and stone
        // $standard->area_id = 14;
        // $standard->floor_type_id = 3;
        // $standard->standard_frequency = 255;
        // $standard->standard_meter_sq_hours = 230;
        // $standard->save();

        $standard = new AreaFloorTypeStandard; // for Cloak room and carpet
        $standard->area_id = 14;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 325;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Cloak room and lino
        $standard->area_id = 14;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 300;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Cloak room and stone
        $standard->area_id = 14;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 300;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Gym + Storage and stone
        $standard->area_id = 15;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 650;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Hall and carpet
        $standard->area_id = 16;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 345;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Hall and lino
        $standard->area_id = 16;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 325;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Hall and stone
        $standard->area_id = 16;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 325;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Office and carpet
        $standard->area_id = 19;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 390;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Office and lino
        $standard->area_id = 19;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 380;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Office and stone
        $standard->area_id = 19;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 380;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Office and carpet with comment = elements 3x a week
        $standard->area_id = 19;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 425;
        $standard->comments = 'elements 3x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Office and lino with comment = elements 3x a week
        $standard->area_id = 19;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 415;
        $standard->comments = 'elements 3x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Office and stone with comment = elements 3x a week
        $standard->area_id = 19;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 415;
        $standard->comments = 'elements 3x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Office and carpet with comment = elements 1x a week
        $standard->area_id = 19;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 500;
        $standard->comments = 'elements 1x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Office and lino with comment = elements 1x a week
        $standard->area_id = 19;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 490;
        $standard->comments = 'elements 1x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Office and stone with comment = elements 1x a week
        $standard->area_id = 19;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 490;
        $standard->comments = 'elements 1x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Kitchen/Pantry and carpet
        $standard->area_id = 17;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 245;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Kitchen/Pantry and lino
        $standard->area_id = 17;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 225;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Kitchen/Pantry and stone
        $standard->area_id = 17;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 225;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Dressing Room and carpet
        $standard->area_id = 18;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 325;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Dressing Room and lino
        $standard->area_id = 18;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 300;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Dressing Room and stone
        $standard->area_id = 18;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 300;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Class Room and carpet
        $standard->area_id = 20;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 390;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Class Room and lino
        $standard->area_id = 20;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 360;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Class Room and stone
        $standard->area_id = 20;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 360;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Class Room and carpet with comment = elements 3x a week
        $standard->20;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 425;
        $standard->comments = 'elements 3x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Class Room and lino with comment = elements 3x a week
        $standard->20;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours =395;
        $standard->comments = 'elements 3x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Class Room and stone with comment = elements 3x a week
        $standard->20;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours =395;
        $standard->comments = 'elements 3x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Class Room and carpet with comment = elements 1x a week
        $standard->20;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 500;
        $standard->comments = 'elements 1x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Class Room and lino with comment = elements 1x a week
        $standard->20;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 465;
        $standard->comments = 'elements 1x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Class Room and stone with comment = elements 1x a week
        $standard->20;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 465;
        $standard->comments = 'elements 1x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Elevator and carpet
        $standard->area_id = 21;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 175;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Elevator and lino
        $standard->area_id = 21;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 160;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Elevator and stone
        $standard->area_id = 21;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 160;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Storage and carpet
        $standard->area_id = 22;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 660;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Storage and lino
        $standard->area_id = 22;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 600;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Storage and stone
        $standard->area_id = 22;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 600;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Receiption Area and carpet
        $standard->area_id = 23;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 350;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Receiption Area and lino
        $standard->area_id = 23;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 315;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Receiption Area and stone
        $standard->area_id = 23;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 315;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Practical Room and carpet
        $standard->area_id = 24;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 350;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Practical Room and lino
        $standard->area_id = 24;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 315;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Practical Room and stone
        $standard->area_id = 24;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 315;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for front desk and carpet
        $standard->area_id = 25;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 355;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for front desk and lino
        $standard->area_id = 25;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 320;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for front desk and stone
        $standard->area_id = 25;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 320;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Repo Room and carpet
        $standard->area_id = 26;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 320;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Repo Room and lino
        $standard->area_id = 26;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 300;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Repo Room and stone
        $standard->area_id = 26;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 300;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Restaurant and carpet
        $standard->area_id = 27;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 245;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Restaurant and lino
        $standard->area_id = 27;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 225;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Restaurant and stone
        $standard->area_id = 27;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 225;
        $standard->save();
        //
        // $standard = new AreaFloorTypeStandard; // for sanitary/washroom and carpet
        // $standard->area_id = 28;
        // $standard->floor_type_id = 1;
        // $standard->standard_frequency = 255;
        // $standard->standard_meter_sq_hours = 245;
        // $standard->save();

        $standard = new AreaFloorTypeStandard; // for sanitary/washroom and lino
        $standard->area_id = 28;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 135;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for sanitary/washroom and stone
        $standard->area_id = 28;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 135;
        $standard->save();

        // $standard = new AreaFloorTypeStandard; // for sanitary/washroom and carpet
        // $standard->area_id = 28;
        // $standard->floor_type_id = 1;
        // $standard->standard_frequency = 255;
        // $standard->standard_meter_sq_hours = 245;
        // $standard->save();

        $standard = new AreaFloorTypeStandard; // for sanitary/washroom and lino
        $standard->area_id = 28;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 510;
        $standard->standard_meter_sq_hours = 210;
        $standard->comments = 'naloop';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for sanitary/washroom and stone
        $standard->area_id = 28;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 510;
        $standard->standard_meter_sq_hours = 210;
        $standard->comments = 'naloop';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for sauna and stone/wood
        $standard->area_id = 28;
        $standard->floor_type_id = 4;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 100;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for show room and carpet
        $standard->area_id = 31;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 400;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for show room and lino
        $standard->area_id = 31;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 375;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for show room and stone
        $standard->area_id = 31;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 375;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for therapy/phsico and carpet
        $standard->area_id = 32;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 375;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for therapy/phsico and lino
        $standard->area_id = 32;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 350;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for therapy/phsico and stone
        $standard->area_id = 32;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 350;
        $standard->save();

        // $standard = new AreaFloorTypeStandard; // for rest room and carpet
        // $standard->area_id = 32;
        // $standard->floor_type_id = 1;
        // $standard->standard_frequency = 255;
        // $standard->standard_meter_sq_hours = 375;
        // $standard->save();

        $standard = new AreaFloorTypeStandard; // for rest room and lino
        $standard->area_id = 33;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 90;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for rest room and stone
        $standard->area_id = 33;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 90;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for rest room and lino with comment= fullow up
        $standard->area_id = 33;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 510;
        $standard->standard_meter_sq_hours = 130;
        $standard->comments = 'fullow up';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for rest room and stone with comment= fullow up
        $standard->area_id = 33;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 510;
        $standard->standard_meter_sq_hours = 130;
        $standard->comments = 'fullow up';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for staircase and carpet
        $standard->area_id = 34;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours =450;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for staircase and lino
        $standard->area_id = 34;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 410;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for staircase and stone
        $standard->area_id = 34;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 410;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for consulting room and carpet
        $standard->area_id = 35;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours =400;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for consulting room and lino
        $standard->area_id = 35;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 380;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for consulting room and stone
        $standard->area_id = 35;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 380;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for consulting room and carpet with comments = elements 3x a week
        $standard->area_id = 35;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours =435;
        $standard->comments = 'elements 3x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for consulting room and lino with comments = elements 3x a week
        $standard->area_id = 35;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 410;
        $standard->comments = 'elements 3x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for consulting room and stone with comments = elements 3x a week
        $standard->area_id = 35;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 310;
        $standard->comments = 'elements 3x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for consulting room and carpet with comments = elements 1x a week
        $standard->area_id = 35;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours =510;
        $standard->comments = 'elements 1x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for consulting room and lino with comments = elements 1x a week
        $standard->area_id = 35;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 490;
        $standard->comments = 'elements 1x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for consulting room and stone with comments = elements 1x a week
        $standard->area_id = 35;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 490;
        $standard->comments = 'elements 1x a week';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Hallway and carpet
        $standard->area_id = 36;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours =675;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Hallway and lino
        $standard->area_id = 36;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 600;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Hallway and stone
        $standard->area_id = 36;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 600;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Hallway and carpet with comments = vloer 1w geheel
        $standard->area_id = 36;
        $standard->floor_type_id = 1;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours =975;
        $standard->comments = 'vloer 1w geheel';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Hallway and lino with comments = vloer 1w geheel
        $standard->area_id = 36;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 865;
        $standard->comments = 'vloer 1w geheel';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for Hallway and stone with comments = vloer 1w geheel
        $standard->area_id = 36;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 865;
        $standard->comments = 'vloer 1w geheel';
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for rest-/dressing room and lino
        $standard->area_id = 37;
        $standard->floor_type_id = 2;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 160;
        $standard->save();

        $standard = new AreaFloorTypeStandard; // for rest-/dressing room and stone
        $standard->area_id = 37;
        $standard->floor_type_id = 3;
        $standard->standard_frequency = 255;
        $standard->standard_meter_sq_hours = 160;
        $standard->save();

        $standard = new AreaFloorTypeStandard;
        $standard->area_id = ;
        $standard->floor_type_id = ;
        $standard->standard_frequency = ;
        $standard->standard_meter_sq_hours = ;
        $standard->save();
    }
}

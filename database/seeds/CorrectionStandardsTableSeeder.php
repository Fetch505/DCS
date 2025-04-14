<?php

use App\Models\CorrectionStandard;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CorrectionStandardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stand = new CorrectionStandard;
        $stand->room_type = 'all';
        $stand->floor_type = 'carpet';
        $stand->frequency = '156';
        $stand->factor_percent = '110';
        $stand->save();

        $stand = new CorrectionStandard;
        $stand->room_type = 'all';
        $stand->floor_type = 'carpet';
        $stand->frequency = '104';
        $stand->factor_percent = '120';
        $stand->save();

        $stand = new CorrectionStandard;
        $stand->room_type = 'all';
        $stand->floor_type = 'carpet';
        $stand->frequency = '52';
        $stand->factor_percent = '135';
        $stand->save();

        $stand = new CorrectionStandard;
        $stand->room_type = 'all';
        $stand->floor_type = 'carpet';
        $stand->frequency = '12';
        $stand->factor_percent = '150';
        $stand->save();

        $stand = new CorrectionStandard;
        $stand->room_type = 'all';
        $stand->floor_type = 'lino & remaining';
        $stand->frequency = '156';
        $stand->factor_percent = '115';
        $stand->save();

        $stand = new CorrectionStandard;
        $stand->room_type = 'all';
        $stand->floor_type = 'lino & remaining';
        $stand->frequency = '104';
        $stand->factor_percent = '130';
        $stand->save();

        $stand = new CorrectionStandard;
        $stand->room_type = 'all';
        $stand->floor_type = 'lino & remaining';
        $stand->frequency = '52';
        $stand->factor_percent = '145';
        $stand->save();

        $stand = new CorrectionStandard;
        $stand->room_type = 'all';
        $stand->floor_type = 'lino & remaining';
        $stand->frequency = '12';
        $stand->factor_percent = '160';
        $stand->save();

        $stand = new CorrectionStandard;
        $stand->room_type = 'sanitary';
        $stand->floor_type = 'remaining';
        $stand->frequency = '156';
        $stand->factor_percent = '108';
        $stand->save();

        $stand = new CorrectionStandard;
        $stand->room_type = 'sanitary';
        $stand->floor_type = 'remaining';
        $stand->frequency = '104';
        $stand->factor_percent = '117';
        $stand->save();

        $stand = new CorrectionStandard;
        $stand->room_type = 'sanitary';
        $stand->floor_type = 'remaining';
        $stand->frequency = '52';
        $stand->factor_percent = '134';
        $stand->save();

        $stand = new CorrectionStandard;
        $stand->room_type = 'sanitary';
        $stand->floor_type = 'remaining';
        $stand->frequency = '12';
        $stand->factor_percent = '145';
        $stand->save();

    }
}

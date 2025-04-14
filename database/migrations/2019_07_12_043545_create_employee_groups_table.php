<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('basic_hour_rate');
            $table->string('gross_hour_wage');
            $table->string('end_year_allowence_value');
            $table->string('end_year_allowence_percent');
            $table->string('holiday_allowence_percent');
            $table->string('holiday_allowence_value');
            $table->string('gross_wage_including_allowaence');
            $table->string('social_insurance_premiums_percent');
            $table->string('social_insurance_premiums_value');
            $table->string('subtotal_wage_costs_per_hour_1');
            $table->string('nationale_holidays_percent');
            $table->string('nationale_holidays_value');
            $table->string('holidays_percent');
            $table->string('holidays_value');
            $table->string('costs_absenteeism_percent');
            $table->string('costs_absenteeism_value');
            $table->string('subtotal_wage_costs_per_hour');
            $table->string('total_wage_costs_per_hour');
            $table->string('material_en_recorses_machines_percent');
            $table->string('material_en_recorses_machines_value');
            $table->string('total_direct_costs');
            $table->string('indirectly_supervision_managementcosts_percent');
            $table->string('indirectly_supervision_managementcosts_value');
            $table->string('workclothing_en_equipment_percent');
            $table->string('workclothing_en_equipment_value');
            $table->string('education_training_percent');
            $table->string('education_training_value');
            $table->string('companycosts_administration_housing_costs_percent');
            $table->string('companycosts_administration_housing_costs_value');
            $table->string('reis_auto_kosten_overige_percent');
            $table->string('reis_auto_kosten_overige_value');
            $table->string('total_indirecte_costs');
            $table->string('risk_and_profit_percent');
            $table->string('risk_and_profit_value');
            $table->string('total_end_wage_normale_workhours_06_to_21');
            $table->string('total_endwage_weekend_incl_50_toeslag');
            $table->string('total_endwage_holidays_incl_150_toeslag');
            $table->string('marge_loonkosten_eindtarief');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_groups');
    }
}

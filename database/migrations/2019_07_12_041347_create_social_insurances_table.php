<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_insurances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year');
            $table->string('WAO_basic_prize');
            $table->string('WAO_calculateprize');
            $table->string('WGA_calculateprize');
            $table->string('total_prize_PEMBA_IVA');
            $table->string('Unemploymentlawww_1');
            $table->string('Redundancy_fund_incl_childcare');
            $table->string('Healtcarelaw');
            $table->string('Pre_pension');
            $table->string('AOP_p');
            $table->string('OP_NP_pension_2');
            $table->string('Pension_transitional_arrangement');
            $table->string('VUT_transitional_arrangement');
            $table->string('Final_levy_VUT_transitional_arrangement');
            $table->string('O_R_zie_RAS_heffing');
            $table->string('Childcare_zie_resdundancy_fund');
            $table->string('RAS_charge');
            $table->string('Totaal_prize_divers');
            $table->string('Totaal_sociale_insurances');
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
        Schema::dropIfExists('social_insurances');
    }
}

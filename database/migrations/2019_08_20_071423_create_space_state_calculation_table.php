<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpaceStateCalculationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('space_state_calculation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sq_meter');
            $table->string('norm');
            $table->string('hours_per_turn');
            $table->string('frequency');
            $table->string('hours_a_year');
            $table->string('rate');
            $table->string('amount');
            $table->string('project_cost_estimates_id');
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
        Schema::dropIfExists('space_state_calculation');
    }
}

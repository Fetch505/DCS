<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaEstimateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_estimate', function (Blueprint $table) {
            $table->increments('id');
            $table->string('floor_type');
            $table->string('room_type');
            $table->string('frequency');
            $table->string('factor');
            $table->string('sq_meter_area_per_hour');
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
        Schema::dropIfExists('area_estimate');
    }
}

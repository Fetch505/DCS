<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectCostProductionTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_cost_production_teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group_name');
            $table->string('group_id');
            $table->string('hourly_rate');
            $table->string('percentage');
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
        Schema::dropIfExists('project_cost_production_teams');
    }
}

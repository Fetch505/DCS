<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRateColumnInProjectCostEstimatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_cost_estimates', function (Blueprint $table) {
          $table->string('rate')->nullable();
          $table->string('total_sq_meter_per_hour')->nullable();
          $table->string('total_hours_a_year')->nullable();
          $table->string('total_hours_a_day')->nullable();
          $table->string('contract_sum_a_year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_cost_estimates', function (Blueprint $table) {
            $table->dropColumn('rate');
            $table->dropColumn('total_sq_meter_per_hour');
            $table->dropColumn('total_hours_a_year');
            $table->dropColumn('total_hours_a_day');
            $table->dropColumn('contract_sum_a_year');
        });
    }
}

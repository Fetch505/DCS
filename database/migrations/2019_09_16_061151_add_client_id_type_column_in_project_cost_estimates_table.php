<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClientIdTypeColumnInProjectCostEstimatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_cost_estimates', function (Blueprint $table) {
            $table->string('client_type')->default('new');
            $table->integer('client_id')->nullable();
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
            $table->dropColumn('client_type');
            $table->dropColumn('client_id');
        });
    }
}

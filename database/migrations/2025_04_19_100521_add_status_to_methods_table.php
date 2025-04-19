<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('health_safety_management', function (Blueprint $table) {
        $table->boolean('status')->default(1);  // Default value could be 1 (Active)
    });
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('methods', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}

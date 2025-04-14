<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFlooIdRoomIdColumnsInAreaEstimateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('area_estimate', function (Blueprint $table) {
          $table->string('floor_type_id')->nullable();
          $table->integer('room_type_id')->nullable();
          $table->string('comment')->default('No Comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('area_estimate', function (Blueprint $table) {
            $table->dropColumn('floor_type_id');
            $table->dropColumn('room_type_id');
            $table->dropColumn('comment');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFloorTypeRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floor_type_room_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_types_id')->unsigned();
            $table->integer('floor_type_id')->unsigned();
            $table->integer('standard_frequency')->unsigned();
            $table->integer('standard_meter_sq_hours')->unsigned();
            $table->string('comments')->default('No Comment')->nullable();
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
        Schema::dropIfExists('floor_type_room_types');
    }
}

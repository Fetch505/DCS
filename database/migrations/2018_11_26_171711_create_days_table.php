<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->increments('id');
            // $table->enum('type',['daily','weekly']);
            $table->string('type')->nullable();
            $table->integer('mon')->default(0);
            $table->integer('tue')->default(0);
            $table->integer('wed')->default(0);
            $table->integer('thu')->default(0);
            $table->integer('fri')->default(0);
            $table->integer('sat')->default(0);
            $table->integer('sun')->default(0);
            $table->integer('element_id')->nullable();
            $table->integer('floor_types_id')->nullable();
            $table->integer('hours')->nullable();
            $table->integer('minutes')->nullable();
            $table->string('time')->nullable();
            $table->string('frequency')->nullable();
            $table->string('factor')->nullable();
            $table->integer('job_id')->nullable();
            $table->integer('task_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->integer('project_id')->nullable();
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
        Schema::dropIfExists('days');
    }
}

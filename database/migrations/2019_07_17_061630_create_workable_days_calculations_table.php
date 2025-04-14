<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkableDaysCalculationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workable_days_calculations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year')->nullable();
            $table->string('number_of_calendar_days')->nullable();
            $table->string('weekend_days')->nullable();
            $table->string('work_days_a_year')->nullable();
            $table->string('nat_holydays_short_absence_bijz_CAO_value')->nullable();
            $table->string('holidays_value')->nullable();
            $table->string('sickdays_value')->nullable();
            $table->string('frost_days_off')->nullable();
            $table->string('workable_days_a_year')->nullable();
            $table->string('nat_holydays_short_absence_bijz_CAO_percent')->nullable();
            $table->string('holidays_percent')->nullable();
            $table->string('sickdays_percent')->nullable();
            $table->string('rage_unworkable_days_in_percent')->nullable();
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
        Schema::dropIfExists('workable_days_calculations');
    }
}

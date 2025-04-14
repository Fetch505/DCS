<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeekCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('week_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('weeknumber');
            $table->integer('days_id')->unsigned();
            $table->string('mon')->default("00:00");
            $table->string('tue')->default("00:00");
            $table->string('wed')->default("00:00");
            $table->string('thu')->default("00:00");
            $table->string('fri')->default("00:00");
            $table->string('sat')->default("00:00");
            $table->string('sun')->default("00:00");
            $table->string('total_hours_per_week')->default("00:00");

            $table->foreign('days_id')->references('id')->on('days')->onDelete('cascade');
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
        Schema::dropIfExists('week_cards');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectJobsElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_jobs_elements', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('jobs_id')->unsigned();
          $table->integer('elements_id')->unsigned();

          $table->foreign('jobs_id')->references('id')->on('project_jobs')->onDelete('cascade');
          $table->foreign('elements_id')->references('id')->on('elements')->onDelete('cascade');
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
        Schema::dropIfExists('project_jobs_elements');
    }
}

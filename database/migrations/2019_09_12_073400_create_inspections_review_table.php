<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspectionsReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections_review', function (Blueprint $table) {
            $table->increments('id');
            $table->string('review')->nullable();
            $table->string('project_id')->nullable();
            $table->string('worker_id')->nullable();
            $table->string('inspector_id')->nullable();
            $table->string('average_score')->nullable();
            $table->string('completed_tasks_count')->nullable();
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
        Schema::dropIfExists('inspections_review');
    }
}

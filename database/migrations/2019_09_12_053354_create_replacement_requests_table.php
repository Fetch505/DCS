<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplacementRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replacement_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('supervisor_id');
            $table->unsignedInteger('user_id');
            $table->string('type');
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->integer('count')->default(0);
            $table->tinyInteger('status')->default(0);

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
        Schema::dropIfExists('replacement_requests');
    }
}

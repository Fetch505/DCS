<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('quotation_id');
            $table->unsignedBigInteger('worker_type_id');
            $table->integer('total_workers');
            $table->decimal('rate', 10, 2); // Either hourly rate or monthly rate depending on the rate_type
            $table->integer('total_hours_per_worker')->nullable(); // Total number of hours (for hourly rate)
            $table->decimal('discount', 10, 2);
            $table->decimal('net_rate', 10, 2); // Net rate after applying discount
            $table->decimal('price', 10, 2);
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
        Schema::dropIfExists('quotation_items');
    }
}

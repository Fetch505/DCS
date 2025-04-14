<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add company_id and quantity fields to the materials table
        Schema::table('materials', function (Blueprint $table) {
            $table->integer('company_id')->unsigned(); // Add the company_id field
            $table->integer('quantity')->default(0); // Add the quantity field
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });

        // Add company_id field to the suppliers table
        Schema::table('suppliers', function (Blueprint $table) {
            $table->integer('company_id')->unsigned(); // Add the company_id field
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });// Update existing records with company_id value 512 in the materials table
        \DB::table('materials')->update(['company_id' => 512]);

        // Update existing records with company_id value 512 in the suppliers table
        \DB::table('suppliers')->update(['company_id' => 512]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the fields from the materials table
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn('company_id');
            $table->dropColumn('quantity');
        });

        // Remove the company_id field from the suppliers table
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });
    }
}
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToMaterialOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('material_order_details', function (Blueprint $table) {
            $table->dropColumn('supplier');
            $table->unsignedBigInteger('supplier_id');
            $table->string('project');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('material_order_details', function (Blueprint $table) {
            $table->dropColumn('supplier_id');
            $table->dropColumn('project');
        });
    }
}

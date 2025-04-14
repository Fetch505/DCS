<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConsumableAndUsageLimitToMaterialCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('material_categories', function (Blueprint $table) {
            $table->boolean('consumable')->default(true); // Indicates if the category is consumable or not
            $table->boolean('has_usage_limit')->default(false); // Indicates if the category has a usage limit
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('material_categories', function (Blueprint $table) {
            $table->dropColumn('consumable');
            $table->dropColumn('has_usage_limit');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostcodeHousenumberColumnInEmployAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employ_agencies', function (Blueprint $table) {
            $table->string('houseNumber')->nullable();
            $table->string('postcode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employ_agencies', function (Blueprint $table) {
            $table->dropColumn('houseNumber');
            $table->dropColumn('postcode');
        });
    }
}

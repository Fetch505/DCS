<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyIdToWorkerTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('worker_types', function (Blueprint $table) {
            $table->integer('company_id')->nullable(false)->default(0);
        });

        $values = 2;
        DB::table('worker_types')->update(['company_id' => $values]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('worker_types', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });
    }
}

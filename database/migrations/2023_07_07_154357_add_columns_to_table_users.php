<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->char('employee_code', 1);
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->date('visa_expiry_date')->nullable();
            $table->date('passport_expiry_date')->nullable();
            $table->date('health_card_expiry_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('employee_code');
            $table->dropColumn('gender');
            $table->dropColumn('visa_expiry_date');
            $table->dropColumn('passport_expiry_date');
            $table->dropColumn('health_card_expiry_date');
        });
    }
}

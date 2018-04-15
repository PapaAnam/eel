<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtRegAndOtHolidayInHrisSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hris_salaries', function (Blueprint $table) {
            $table->double('ot_regular');
            $table->double('ot_holiday');
            $table->string('ot_regular_in_hours');
            $table->string('ot_holiday_in_hours');
        });
        Schema::table('hris_salaries', function (Blueprint $table) {
            $table->dropColumn('over_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hris_salaries', function (Blueprint $table) {
            $table->dropColumn('ot_regular');
            $table->dropColumn('ot_holiday');
            $table->dropColumn('ot_regular_in_hours');
            $table->dropColumn('ot_holiday_in_hours');
        });
        Schema::table('hris_salaries', function (Blueprint $table) {
            $table->double('over_time');
        });
    }
}

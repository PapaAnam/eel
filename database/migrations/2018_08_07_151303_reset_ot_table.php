<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ResetOtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hris_over_times', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('pay');
            $table->dropColumn('employee');
        });
        Schema::table('hris_over_times', function (Blueprint $table) {
            $table->year('year');
            $table->string('month',2);
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('hris_employees')->onUpdate('cascade')->onDelete('cascade');
            $table->double('ot_regular_in_hours')->nullable();
            $table->double('ot_holiday_in_hours')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hris_over_times', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
        });
        Schema::table('hris_over_times', function (Blueprint $table) {
            $table->dropColumn('year');
            $table->dropColumn('month');
            $table->dropColumn('employee_id');
            $table->dropColumn('ot_regular_in_hours');
            $table->dropColumn('ot_holiday_in_hours');
        });
        Schema::table('hris_over_times', function (Blueprint $table) {
            $table->string('created_at');
            $table->string('pay');
            $table->string('employee');
        });
    }
}

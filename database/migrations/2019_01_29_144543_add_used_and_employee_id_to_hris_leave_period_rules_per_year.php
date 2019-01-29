<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsedAndEmployeeIdToHrisLeavePeriodRulesPerYear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hris_leave_period_rules_per_year', function (Blueprint $table) {
            $table->integer('used')->default(0);
            $table->integer('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('hris_employees')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hris_leave_period_rules_per_year', function (Blueprint $table) {
            $table->dropColumn('used');
            $table->dropForeign(['employee_id']);
        });
        Schema::table('hris_leave_period_rules_per_year', function (Blueprint $table) {
            $table->dropColumn('employee_id');
        });
    }
}

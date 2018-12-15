<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdAndYearRuleLeavePeriod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hris_leave_period_rules', function (Blueprint $table) {
            $table->year('rule_year')->default(2018);
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->on('hris_users')->references('id')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hris_leave_period_rules', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('hris_leave_period_rules', function (Blueprint $table) {
            $table->dropColumn('rule_year');
            $table->dropColumn('user_id');
        });
    }
}

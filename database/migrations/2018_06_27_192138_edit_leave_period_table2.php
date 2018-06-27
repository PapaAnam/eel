<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditLeavePeriodTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hris_leave_periods', function (Blueprint $table) {
            $table->dropColumn('special_permit');
            $table->dropColumn('holiday');
            $table->dropColumn('father_leave');
            $table->dropColumn('sick');
            $table->dropColumn('pregnancy');
            $table->dropColumn('year');
        });
        Schema::table('hris_leave_periods', function (Blueprint $table) {
            $table->string('type');
            $table->tinyInteger('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hris_leave_periods', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('total');
            $table->dropColumn();
        });
        Schema::table('hris_leave_periods', function (Blueprint $table) {
            $table->integer('special_permit');
            $table->integer('holiday');
            $table->integer('father_leave');
            $table->integer('sick');
            $table->integer('pregnancy');
            $table->integer('year');
        });
    }
}

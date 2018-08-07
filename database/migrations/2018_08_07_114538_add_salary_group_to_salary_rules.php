<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalaryGroupToSalaryRules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hris_salary_rules', function (Blueprint $table) {
            $table->integer('salary_group_id')->unsigned()->nullable();
            $table->foreign('salary_group_id')->references('id')->on('hris_salary_group')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hris_salary_rules', function (Blueprint $table) {
            $table->dropForeign(['salary_group_id']);
        });
        Schema::table('hris_salary_rules', function (Blueprint $table) {
            $table->integer('salary_group_id')->unsigned()->nullable();
        });
    }
}

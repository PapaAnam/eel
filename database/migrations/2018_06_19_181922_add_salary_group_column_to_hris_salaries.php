<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalaryGroupColumnToHrisSalaries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hris_salaries', function (Blueprint $table) {
            $table->integer('salary_group')->nullable()->unsigned();
        });
        Schema::table('hris_salaries', function (Blueprint $table) {
            $table->foreign('salary_group')->references('id')->on('hris_salary_group')->onDelete('set null')->onUpdate('set null');
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
            $table->dropForeign(['salary_group']);
        });
        Schema::table('hris_salaries', function (Blueprint $table) {
            $table->dropColumn('salary_group');
        });
    }
}

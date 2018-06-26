<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalaryTypeForSalaries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hris_salaries', function (Blueprint $table) {
            $table->string('salary_type')->default('standart');
            $table->tinyInteger('present_total', 2);
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
            $table->dropColumn('salary_type');
            $table->dropColumn('present_total');
        });
    }
}

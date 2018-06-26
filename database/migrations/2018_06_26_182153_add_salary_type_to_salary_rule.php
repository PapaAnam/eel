<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalaryTypeToSalaryRule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('hris_employees', 'salary_type')) {
            Schema::table('hris_employees', function (Blueprint $table) {
                $table->dropColumn('salary_type');
            });
        }
        if (Schema::hasColumn('hris_salaries', 'salary_type')) {
            Schema::table('hris_salaries', function (Blueprint $table) {
                $table->dropColumn('salary_type');
            });
        }
        if (Schema::hasColumn('hris_salaries', 'present_total')) {
            Schema::table('hris_salaries', function (Blueprint $table) {
                $table->dropColumn('present_total');
            });
        }
        Schema::table('hris_salary_rules', function (Blueprint $table) {
            $table->string('salary_type')->default('standart');
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
            $table->dropColumn('salary_type');
        });
    }
}

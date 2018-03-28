<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// use DB;

class AddDepartmentAndDropSubDepartmentInHrisSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('hris_salaries')->truncate();
        Schema::table('hris_salaries', function (Blueprint $table) {
            if(Schema::hasColumn('hris_salaries', 'sub_department')){
                $table->dropColumn('sub_department');
            }
        });
        Schema::table('hris_salaries', function (Blueprint $table) {
            if(!Schema::hasColumn('hris_salaries', 'department')){
                $table->integer('department')->unsigned();
            }
            if(!Schema::hasColumn('hris_salaries', 'salary_rule')){
                $table->integer('salary_rule')->unsigned();
            }
            $table->foreign('department')->references('id')->on('hris_departments');
            $table->foreign('salary_rule')->references('id')->on('hris_salary_rules');
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
            $table->integer('sub_department')->unsigned();
        });
        Schema::table('hris_salaries', function (Blueprint $table) {
            $table->dropForeign(['department']);
            $table->dropForeign(['salary_rule']);
            $table->dropColumn('department');
            $table->dropColumn('salary_rule');
        });
    }
}

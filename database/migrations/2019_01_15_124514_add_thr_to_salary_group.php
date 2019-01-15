<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThrToSalaryGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hris_salary_group', function (Blueprint $table) {
            $table->enum('thr',[0,1])->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hris_salary_group', function (Blueprint $table) {
            $table->dropColumn('thr');
        });
    }
}

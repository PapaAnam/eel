<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HrisSalaryGrup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hris_salary_group', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('basic_salary', range(0,1))->default('0')->nullable();
            $table->enum('allowance', range(0,1))->default('0')->nullable();
            $table->enum('ot_regular', range(0,1))->default('0')->nullable();
            $table->enum('ot_holiday', range(0,1))->default('0')->nullable();
            $table->enum('incentive', range(0,1))->default('0')->nullable();
            $table->enum('food_allowance', range(0,1))->default('0')->nullable();
            $table->enum('rent_motorcycle', range(0,1))->default('0')->nullable();
            $table->enum('retention', range(0,1))->default('0')->nullable();
            $table->enum('tax_insurance', range(0,1))->default('0')->nullable();
            $table->enum('seguranca_social', range(0,1))->default('0')->nullable();
            $table->enum('cash_withdrawal', range(0,1))->default('0')->nullable();
            $table->enum('absent', range(0,1))->default('0')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hris_salary_group');
    }
}

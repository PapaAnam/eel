<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrisLeavePeriodRules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hris_leave_period_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('employee_type', ['local', 'international']);
            $table->tinyInteger('special_permit');
            $table->tinyInteger('holiday');
            $table->tinyInteger('father_leave');
            $table->tinyInteger('sick');
            $table->tinyInteger('pregnancy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hris_leave_period_rules');
    }
}

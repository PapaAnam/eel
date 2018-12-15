<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrisLeavePeriodRulesPerYear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hris_leave_period_rules_per_year', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('hris_leave_period_names')->onUpdate('cascade')->onDelete('cascade');
            $table->year('rule_year')->default(2018);
            $table->integer('qty_max')->unsigned()->default(0);
            $table->string('is_local')->default('true');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->on('hris_users')->references('id')->onUpdate('set null')->onDelete('set null');
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
        Schema::dropIfExists('hris_leave_period_rules_per_year');
    }
}

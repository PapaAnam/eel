<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLeavePeriod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('hris_leave_periods');
        Schema::create('hris_leave_periods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->on('hris_employees')->references('id')->onUpdate('set null')->onDelete('set null');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->on('hris_users')->references('id')->onUpdate('set null')->onDelete('set null');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('day_total');
            $table->integer('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->on('hris_leave_period_names')->references('id')->onUpdate('set null')->onDelete('set null');
            $table->string('status')->nullable();
            $table->text('attachment')->nullable();
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
        //
    }
}

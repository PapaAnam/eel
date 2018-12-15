<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrisLeavePeriodNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hris_leave_period_names', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status_name');
            $table->string('joining_date')->default('true');
            $table->string('only_female')->default('false');
            $table->string('only_maried')->default('false');
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
        Schema::dropIfExists('hris_leave_period_names');
    }
}

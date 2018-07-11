<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashWithdrawalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hris_cash_withdrawal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('applicant_id')->unsigned();
            $table->integer('job_title_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->integer('hrd_id')->unsigned();
            $table->integer('manager_id')->unsigned();
            $table->double('total');
            $table->string('reason');
            $table->double('installment');
            $table->char('month_start',2);
            $table->year('year_start');
            $table->char('month_end',2);
            $table->year('year_end');
            $table->date('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hris_cash_withdrawal');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSegurancaAndCashReceiptInHrisSalaryRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hris_salary_rules', function (Blueprint $table) {
            $table->integer('seguranca_social');
            $table->integer('cash_receipt');
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
            $table->dropColumn('seguranca_social');
            $table->dropColumn('cash_receipt');
        });
    }
}

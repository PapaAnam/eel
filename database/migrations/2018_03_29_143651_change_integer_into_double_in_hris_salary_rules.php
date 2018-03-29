<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIntegerIntoDoubleInHrisSalaryRules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hris_salary_rules', function (Blueprint $table) {
            $table->dropColumn([
                'ritation', 'etc', 'seguranca_social', 'cash_receipt'
            ]);
        });
        Schema::table('hris_salary_rules', function (Blueprint $table) {
            $table->double('ritation');
            $table->double('etc');
            $table->double('seguranca_social');
            $table->double('cash_receipt');
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
            //
        });
    }
}

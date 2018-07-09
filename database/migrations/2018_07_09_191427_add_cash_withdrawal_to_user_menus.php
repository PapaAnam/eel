<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCashWithdrawalToUserMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hris_user_menus', function (Blueprint $table) {
            $table->enum('cash_withdrawal', range(0,1))->default('0');
        });
        Schema::table('hris_user_menus', function (Blueprint $table) {
            $table->dropColumn('over_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hris_user_menus', function (Blueprint $table) {
            $table->enum('over_time', range(0,1));
        });
        Schema::table('hris_user_menus', function (Blueprint $table) {
            $table->dropColumn('cash_withdrawal');
        });
    }
}

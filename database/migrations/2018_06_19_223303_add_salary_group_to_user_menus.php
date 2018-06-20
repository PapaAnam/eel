<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalaryGroupToUserMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hris_user_menus', function (Blueprint $table) {
            $table->enum('salary_group', range(0,1))->default('0');
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
            $table->dropColumn('salary_group');
        });
    }
}

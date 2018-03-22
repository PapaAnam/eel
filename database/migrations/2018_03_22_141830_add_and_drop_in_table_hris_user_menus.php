<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAndDropInTableHrisUserMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hris_user_menus', function (Blueprint $table) {
            $table->dropColumn('sub_department');
            $table->dropColumn('position');
        });
        Schema::table('hris_user_menus', function (Blueprint $table) {
            $table->enum('job_title', range(0,1))->default('0');
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
            $table->dropColumn('job_title');
        });
        Schema::table('hris_user_menus', function (Blueprint $table) {
            $table->enum('sub_department', range(0,1))->default('0');
            $table->enum('position', range(0,1))->default('0');
        });
    }
}

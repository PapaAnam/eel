<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSubDepInMutationToDepartment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hris_mutations', function (Blueprint $table) {
            $table->dropColumn('old_department');
            $table->dropColumn('new_department');
        });

        Schema::table('hris_mutations', function (Blueprint $table) {
            $table->integer('old_department')->unsigned();
            $table->integer('new_department')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hris_mutations', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeStatusAttendanceNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hris_attendances', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('hris_attendances', function (Blueprint $table) {
            // $table->enum('status', [
            //     'Present', 'Sick', 'Absent', 'Official Travel', 'Father Leave', 'Holiday', 'Special Permit', 'Pregnancy',
            // ])->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('hris_attendances', function (Blueprint $table) {
        //     //
        // });
    }
}

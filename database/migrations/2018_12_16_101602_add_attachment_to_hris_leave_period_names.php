<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttachmentToHrisLeavePeriodNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hris_leave_period_names', function (Blueprint $table) {
            $table->string('attachment')->default('false');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hris_leave_period_names', function (Blueprint $table) {
            $table->dropColumn('attachment');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFleetSalesOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet_sales_order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('KodeNota');
            $table->enum('Status', [
                'Proses Kirim', 'Terkirim', 'Ditolak'
            ]);
            $table->text('AlasanDitolak')->nullable();
            $table->string('Sopir');
            $table->timestamp('DikirimPada');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fleet_sales_order');
    }
}

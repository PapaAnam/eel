<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerOutlet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketing_customer_outlets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('outlet_code',50);
            $table->string('outlet_name');
            $table->text('address');
            $table->string('district',50);
            $table->string('phone_number',30);
            $table->string('contact_person',30);
            $table->string('segment',50);
            $table->string('salesman',50);
            $table->string('division',30);
            $table->string('latitude',30);
            $table->string('longitude',30);
            $table->string('icon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketing_customer_outlets');
    }
}

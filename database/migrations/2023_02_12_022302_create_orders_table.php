<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reception_id');
            $table->foreignId('service_id');
            $table->foreignId('therapist_id');
            $table->foreignId('place_id');
            $table->foreignId('discount_id');
            $table->string('cust_name');
            $table->string('phone');
            $table->integer('time');
            $table->integer('price');
            $table->string('payment_method');
            $table->string('description')->nullable();
            $table->string('summary');
            $table->timestamps();
            $table->time('start_service');
            $table->time('end_service');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

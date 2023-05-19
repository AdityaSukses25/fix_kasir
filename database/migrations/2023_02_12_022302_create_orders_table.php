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
            // $table->foreignId('service_extra_time_id')->nullable();
            $table->foreignId('therapist_id');
            $table->foreignId('place_id');
            $table->string('cust_name', 50);
            $table->string('orderID', 20);
            $table->string('phone', 15);
            $table->integer('time');
            // $table->integer('extra_time')->nullable();
            $table->integer('price');
            $table->integer('discount')->nullable();
            // $table->integer('price_extra_time')->nullable();
            $table->string('payment_method', 20);
            $table->string('description')->nullable();
            $table->integer('summary');
            $table->time('start_service')->nullable();
            $table->time('end_service')->nullable();
            // $table->time('end_extra_time')->nullable();
            $table->string('status', 15);
            $table->timestamps();
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('therapist_id')->nullable();
            $table->foreignId('service_extra_time_id')->nullable();
            $table->integer('extra_time')->nullable();
            $table->integer('price_extra_time')->nullable();
            $table->time('start_extra_time')->nullable();
            $table->time('end_extra_time')->nullable();
            $table->integer('summary_extra_time')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('extra_times');
    }
}

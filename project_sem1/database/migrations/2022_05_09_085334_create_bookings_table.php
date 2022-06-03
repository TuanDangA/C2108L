<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('details', 255);
            $table->integer('quantity');
            $table->float('price');
            $table->date('arrival_date');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_event');
            $table->foreign('id_user')->references('id')->on('accounts');
            $table->foreign('id_event')->references('id')->on('events');
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
        Schema::dropIfExists('bookings');
    }
};

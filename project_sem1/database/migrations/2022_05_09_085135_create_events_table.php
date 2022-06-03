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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->longtext('content');
            $table->string('image', 255);           
            $table->string('href_param', 255);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->float('price');
            $table->string('location', 255);
            $table->unsignedBigInteger('id_event_category');
            $table->foreign('id_event_category')->references('id')->on('event_categories');
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
        Schema::dropIfExists('events');
    }
};

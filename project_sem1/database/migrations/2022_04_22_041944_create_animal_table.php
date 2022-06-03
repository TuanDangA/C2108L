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
        Schema::create('animal', function (Blueprint $table) {
            $table->id();
            $table->string('normal_name',255);
            $table->string('scientific_name',255);
            $table->unsignedBigInteger('id_category');
            $table->unsignedBigInteger('id_range');
            $table->longtext('habitat');
            $table->longtext('overview');
            $table->string('shortThumbnail',255);
            $table->string('longThumbnail',255);
            $table->string('hrefParam',255);
            $table->longtext('diet');
            $table->longtext('size');
            $table->longtext('population_status');
            $table->timestamps();
            $table->foreign('id_category')->references('id')->on('categories_animal');
            $table->foreign('id_range')->references('id')->on('ranges');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal');
    }
};

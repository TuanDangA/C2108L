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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title',255);
            $table->longtext('description');
            $table->unsignedBigInteger('id_category_post');
            $table->unsignedBigInteger('id_author');
            $table->longtext('content');
            $table->longtext('hrefParam');
            $table->string('shortThumbnail',255);
            $table->string('longThumbnail',255);
            $table->foreign('id_category_post')->references('id')->on('categories_post');
            $table->foreign('id_author')->references('id')->on('authors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};

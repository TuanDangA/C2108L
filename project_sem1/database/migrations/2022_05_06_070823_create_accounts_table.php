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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 50);
            $table->string('email', 100)->unique();
            $table->string('phone', 16)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('gender', 6)->nullable();
            $table->date('dob')->nullable();
            $table->string('token', 32)->nullable();
            $table->boolean('confirmed')->default(0);
            $table->string('confirmation_code', 32)->nullable();
            $table->unsignedBigInteger('id_rule_user');
            $table->string('password', 40);
            $table->string('image', 2048)->nullable();
            $table->foreign('id_rule_user')->references('id')->on('rule_account');
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
        Schema::dropIfExists('accounts');
    }
};

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
        schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('psid');
            $table->unsignedInteger('supervisor_id');
            $table->string('type',32);
            $table->string('title',256);
            $table->string('content',1024);
            $table->boolean('redeemed');
            $table->timestamps();
            $table->foreign('supervisor_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('psid')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewards');
    }
};

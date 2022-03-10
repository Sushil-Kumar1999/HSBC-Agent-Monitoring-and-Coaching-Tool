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
        schema::create('user-metrics', function (Blueprint $table) {
            $table->unsignedBigInteger('psid');
            $table->string('site',64);
            $table->enum('qualifier', ['Good', 'Medium', 'Low']);
            $table->double('ccpoh', 22, 20);
            $table->double('art', 22, 20);
            $table->double('nps', 22, 20);
            $table->double('fcr', 22, 20);
            $table->double('online_percentage', 22, 20);
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
        //
    }
};

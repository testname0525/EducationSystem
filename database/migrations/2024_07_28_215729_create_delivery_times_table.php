<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('delivery_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('curriculum_id');  
            $table->dateTime('delivery_from');
            $table->dateTime('delivery_to');
            $table->timestamps();

            $table->foreign('curriculum_id')->references('id')->on('curricula');
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_times');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('apartment_sponsor', function (Blueprint $table) {
            $table->unsignedBigInteger('apartment_id');
            $table->unsignedBigInteger('sponsor_id');
            $table->foreign('apartment_id')->references('id')->on('apartments');
            $table->foreign('sponsor_id')->references('id')->on('sponsors');

            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->boolean('valid')->default(true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('apartment_sponsor');
    }
};
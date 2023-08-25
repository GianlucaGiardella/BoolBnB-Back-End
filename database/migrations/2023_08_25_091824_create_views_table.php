<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();

            $table->smallInteger("visit_date")->nullable();
            $table->string("visitor_ip", 50)->nullable();

            $table->unsignedBigInteger('apartment_id')->default(null);
            $table->foreign('apartment_id')->references('id')->on('apartments');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('views');
    }
};
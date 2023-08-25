<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string("name", 30)->nullable(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};
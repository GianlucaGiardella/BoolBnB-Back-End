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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();

            $table->string('title', 255);
            $table->text('description');
            $table->smallInteger('price');
            $table->string('latitude', 50);
            $table->string('longitude', 50);
            $table->smallInteger('size');
            $table->tinyInteger('rooms');
            $table->tinyInteger('beds');
            $table->tinyInteger('beds');
            $table->boolean('visibility');
            $table->string('cover', 255);

            // creo la colonna della chiave esterna
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('image_id');
            $table->unsignedBigInteger('view_id');

            // definire la colonna come chiave esterna
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('view_id')->references('id')->on('views');


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
        Schema::dropIfExists('apartments');
    }
};

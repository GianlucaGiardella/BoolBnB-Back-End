<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();

            // creo la colonna della chiave esterna
            $table->unsignedBigInteger('user_id');

            // definire la colonna come chiave esterna
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('country', 3);
            $table->string('street');
            $table->string('zip', 12);
            $table->string('latitude', 15);
            $table->string('longitude', 15);
            $table->integer('size');
            $table->tinyInteger('rooms');
            $table->tinyInteger('beds');
            $table->tinyInteger('bathrooms');
            $table->boolean('visibility')->nullable();
            $table->string('cover')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('apartments', function (Blueprint $table) {

            // elimino la chiave esterna
            $table->dropForeign('apartments_user_id_foreign');

            // elimino la colonna
            $table->dropIfExists('apartments');
        });
    }
};
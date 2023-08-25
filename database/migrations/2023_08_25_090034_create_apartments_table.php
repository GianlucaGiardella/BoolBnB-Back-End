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
            $table->string('price')->nullable();
            $table->string('latitude', 50)->nullable();
            $table->string('longitude', 50)->nullable();
            $table->smallInteger('size');
            $table->tinyInteger('rooms');
            $table->tinyInteger('beds');
            $table->tinyInteger('bathrooms');
            $table->boolean('visibility');
            $table->string('cover', 255)->nullable();

            // creo la colonna della chiave esterna
            $table->unsignedBigInteger('user_id');

            // definire la colonna come chiave esterna
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::table('apartments', function (Blueprint $table) {
            // elimino la chiave esterna

            $table->dropForeign('apartments_user_id_foreign');

            // elimino la colonna

            $table->dropColumn('user_id');
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('apartments', function (Blueprint $table) {
            // $table->unsignedBigInteger('image_id');
            // $table->unsignedBigInteger('view_id');

            // $table->foreign('view_id')->references('id')->on('views');
            // $table->foreign('image_id')->references('id')->on('images');
        });
    }

    public function down()
    {
        Schema::table('apartments', function (Blueprint $table) {
            // $table->dropForeign('apartments_image_id_foreign');
            // $table->dropForeign('apartments_view_id_foreign');

            // $table->dropColumn('image_id');
            // $table->dropColumn('view_id');
        });
    }
};
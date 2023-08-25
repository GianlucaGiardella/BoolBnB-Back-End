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

            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id')->references('id')->on('apartments');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('views', function (Blueprint $table) {
            $table->dropForeign('apartment_view_id_foreign');

            $table->dropColumn('apartment_id');
        });
    }
};
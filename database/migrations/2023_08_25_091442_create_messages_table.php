<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->string('email_sender', 30);
            $table->text('text_message');
            $table->string('sent_date');
            $table->timestamps();
            $table->foreignId('apartment_id');
            $table->foreign('apartment_id')->references('id')->on('apartments');
        });
    }

    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign('apartment_id_foreign');

            $table->dropColumn('apartment_id');
        });
    }
};
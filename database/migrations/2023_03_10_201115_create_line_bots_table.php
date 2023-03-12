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
        Schema::create('line_bots', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('timestamp')->comment("13 位數的 unix timestamp, 4 byte 儲存不了");
            $table->string('reply_token');
            $table->string('user_id');
            $table->string('event_source_id');
            $table->longText('text');
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
        Schema::dropIfExists('line_bots');
    }
};

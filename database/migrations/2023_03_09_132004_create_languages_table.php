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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('chinese_name');
            $table->string('english_name')->comment('english_name');
            $table->string('code', 8)->comment('ISO-639 code');
            $table->string('origin_language')->comment('原文翻譯');
            $table->boolean('is_online')->default(false)->comment('線上是否開啟');
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
        Schema::dropIfExists('languages');
    }
};

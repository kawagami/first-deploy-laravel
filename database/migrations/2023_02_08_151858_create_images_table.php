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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('擁有者 ID');
            $table->enum('status', [-1, 0, 1])->default(0)->comment("-1:停用 0:暫存 1:啟用");
            $table->string('name')->comment('儲存進網站後的名字');
            $table->string('url')->comment('在網站中可實際取得圖片的連結');
            $table->string('original_name')->comment('儲存時原始的名字');
            // $table->softDeletes();
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
        Schema::dropIfExists('images');
    }
};

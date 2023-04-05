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
        Schema::create('hackmd_note_lists', function (Blueprint $table) {
            $table->id();
            $table->boolean("is_public")->default(false)->comment("決定是否要在公開頁面顯示");
            $table->string("hackmd_note_lists_id");
            $table->string("title");
            $table->unsignedBigInteger('createdAt')->comment("13 位數的 unix timestamp, 4 byte 儲存不了");
            $table->string("publishType");
            $table->unsignedBigInteger("publishedAt")->nullable();
            $table->string("permalink")->nullable();
            $table->string("publishLink");
            $table->string("shortId");
            $table->unsignedBigInteger('lastChangedAt')->comment("13 位數的 unix timestamp, 4 byte 儲存不了");
            $table->json("lastChangeUser");
            $table->string("userPath");
            $table->string("teamPath")->nullable();
            $table->string("readPermission");
            $table->string("writePermission");
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
        Schema::dropIfExists('hackmd_note_lists');
    }
};

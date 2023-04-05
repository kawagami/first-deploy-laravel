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
        Schema::create('hackmd_notes', function (Blueprint $table) {
            $table->id();

            $table->string("hackmd_note_id");
            $table->string("title");
            $table->unsignedBigInteger("createdAt");
            $table->string("publishType");
            $table->unsignedBigInteger("publishedAt")->nullable();
            $table->string("permalink")->nullable();
            $table->string("publishLink");
            $table->string("shortId");
            $table->longText("content");
            $table->unsignedBigInteger("lastChangedAt");
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
        Schema::dropIfExists('hackmd_notes');
    }
};

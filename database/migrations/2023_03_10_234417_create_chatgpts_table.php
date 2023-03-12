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
        Schema::create('chatgpts', function (Blueprint $table) {
            $table->id();
            $table->string('sent_message');
            // success
            $table->string('data_id')->comment('回應傳來的 id 值');
            $table->string('object');
            $table->unsignedInteger('created')->comment('10 位數 int');
            $table->string('model');
            $table->unsignedSmallInteger('usage_prompt_tokens');
            $table->unsignedSmallInteger('usage_completion_tokens');
            $table->unsignedSmallInteger('usage_total_tokens');
            $table->string('choices_message_role');
            $table->longText('choices_message_content')->comment('received messages');
            $table->string('choices_finish_reason');
            $table->string('choices_index');
            //
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
        Schema::dropIfExists('chatgpts');
    }
};

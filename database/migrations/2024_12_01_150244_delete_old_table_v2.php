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
        //
        Schema::dropIfExists('hackmd_note_lists');
        Schema::dropIfExists('hackmd_notes');
        Schema::dropIfExists('hackmd_tags');
        Schema::dropIfExists('hackmd_note_tag');
        Schema::dropIfExists('hackmd_note_list_tag');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

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
        Schema::create('sg_vites', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('武將名稱');
            $table->string('camp')->comment('國家');
            $table->integer('cost')->comment('Cost');
            $table->char('cavalry', 1)->comment('騎兵等級');
            $table->char('shieldbearer', 1)->comment('盾冰等級');
            $table->char('archer', 1)->comment('弓兵等級');
            $table->char('spearman', 1)->comment('槍兵等級');
            $table->char('artillery', 1)->comment('器械等級');
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
        Schema::dropIfExists('sg_vites');
    }
};

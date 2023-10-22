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
        Schema::create('blog_component_images', function (Blueprint $table) {
            $table->id();
            $table->integer('component_id');
            $table->string('image_id')->comment('存在 image 的 ID');
            $table->string('name')->comment('存在 storage 的名稱');
            $table->string('url')->comment('前端可取得圖片的 url');
            $table->string('original_name')->comment('原始檔案名稱');
            $table->enum('status', ['-1', '0', '1'])->default('0')->comment('-1:停用 0:暫存 1:啟用');
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
        Schema::dropIfExists('blog_component_images');
    }
};

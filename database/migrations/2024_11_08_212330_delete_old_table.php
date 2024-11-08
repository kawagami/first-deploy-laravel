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
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('blog_components');
        Schema::dropIfExists('blog_component_images');
        Schema::dropIfExists('blog_component_articles');
        Schema::dropIfExists('sg_vites');
        Schema::dropIfExists('chatgpt_errors');
        Schema::dropIfExists('chatgpts');
        Schema::dropIfExists('line_bots');
        Schema::dropIfExists('languages');

        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::dropIfExists($tableNames['role_has_permissions']);
        Schema::dropIfExists($tableNames['model_has_roles']);
        Schema::dropIfExists($tableNames['model_has_permissions']);
        Schema::dropIfExists($tableNames['roles']);
        Schema::dropIfExists($tableNames['permissions']);

        Schema::dropIfExists('short_urls');
        Schema::dropIfExists('user_logins');
        Schema::dropIfExists('notes');
        Schema::dropIfExists('images');
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('password_resets');
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

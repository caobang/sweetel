<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->unsignedTinyInteger('id')->unique();
            $table->unsignedTinyInteger('parent_id')->default(0)->comment('父节点id');
            $table->string('name')->comment('名称');
            $table->unsignedTinyInteger('defaultstatus')->comment('默认权限状态');// 1默认拥有 2默认没有 3默认继承父节点
            $table->boolean('enabled')->default(1)->comment('有效');
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
        Schema::dropIfExists('permissions');
    }
}

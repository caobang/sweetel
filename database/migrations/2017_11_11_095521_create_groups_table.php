<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('parent_id')->default(0)->comment('父节点id');
            $table->unsignedTinyInteger('grouptype')->comment('分组类型');// 1用户组 2客服组 3知识库分类 4客户组 5工单分类
            $table->string('name')->comment('名称');
            $table->unsignedInteger('team_id')->comment('所属团队');//0系统共用
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
        Schema::dropIfExists('groups');
    }
}

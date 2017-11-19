<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('userhead')->nullable()->comment('用户头像');
            $table->string('nickname')->nullable()->comment('用户昵称');
            $table->unsignedTinyInteger('status')->default(1)->comment('用户状态');//1上线 2离开 3隐身
            $table->unsignedTinyInteger('loginstatus')->default(0)->comment('登录状态');//1在线 0离线
            $table->string('activation_token',100)->nullable()->comment('激活token');//null 激活状态
            $table->unsignedInteger('team_id')->comment('所属团队');
            $table->unsignedInteger('role_id')->comment('所属角色');
            $table->unsignedInteger('group_id')->comment('用户组id');
            //$table->unsignedInteger('chatgroup_id')->comment('客服组id');
            //$table->boolean('enabled')->default(1)->comment('有效');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('userhead');
            $table->dropColumn('nickname');
            $table->dropColumn('status');
            $table->dropColumn('loginstatus');
            $table->dropColumn('activation_token');
            $table->dropColumn('team_id');
            $table->dropColumn('role_id');
            $table->dropColumn('group_id');
            //$table->dropColumn('chatgroup_id');
            $table->dropColumn('deleted_at');
        });
    }
}

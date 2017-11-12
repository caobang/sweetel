<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRobotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('robots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname')->comment('昵称');
            $table->string('userhead')->nullable()->comment('头像');
            $table->string('signature')->nullable()->comment('签名');
            $table->string('welcome')->nullable()->comment('欢迎语');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态');// 1机器人优先 2客服优先 3关闭
            $table->unsignedInteger('team_id')->comment('所属团队');
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
        Schema::dropIfExists('robots');
    }
}

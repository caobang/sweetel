<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupusers', function (Blueprint $table) {
            $table->unsignedInteger('group_id')->comment('组id');
            $table->unsignedInteger('user_id')->comment('用户id');
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
        Schema::dropIfExists('groupusers');
    }
}

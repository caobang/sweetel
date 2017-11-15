<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名称');
            $table->string('email')->comment('邮箱');
            $table->string('tel')->comment('电话');
            $table->string('phone')->comment('手机');
            $table->string('company')->comment('公司');
            $table->string('remark')->comment('备注');
            $table->unsignedTinyInteger('fromtype');//来源类型 1桌面网站 2移动手机 3微信 4App 5客户中心
            $table->unsignedInteger('group_id')->comment('组id');
            $table->timestamps();
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
        Schema::dropIfExists('customers');
    }
}

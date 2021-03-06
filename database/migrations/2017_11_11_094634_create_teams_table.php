<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('团队名称');
            $table->string('tel')->nullable()->comment('电话');
            $table->string('contact')->nullable()->comment('联系人');
            $table->string('phone')->nullable()->comment('手机');
            $table->string('address')->nullable()->comment('地址');
            $table->unsignedTinyInteger('businesstype')->default(1)->comment('商业类型');//1免费版 2专业版 3定制版
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
        Schema::dropIfExists('teams');
    }
}

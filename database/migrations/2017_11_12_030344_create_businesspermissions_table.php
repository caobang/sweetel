<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinesspermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesspermissions', function (Blueprint $table) {
            $table->unsignedTinyInteger('businesstype')->comment('商业类型');
            $table->unsignedInteger('permission_id')->comment('权限id');
            $table->boolean('permissionstatus')->comment('权限状态');
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
        Schema::dropIfExists('businesspermissions');
    }
}

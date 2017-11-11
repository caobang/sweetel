<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeammodulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teammodules', function (Blueprint $table) {
            $table->unsignedInteger('team_id')->comment('团队id');
            $table->unsignedInteger('module_id')->comment('模块id');
            $table->boolean('enabled')->default(0)->comment('有效');
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
        Schema::dropIfExists('teammodules');
    }
}

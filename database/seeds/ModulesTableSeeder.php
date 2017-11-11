<?php

use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            'id' => 1,
            'name' => '主页',
            'moduletype' => 1
        ]);
        DB::table('modules')->insert([
            'id' => 2,
            'name' => '用户中心',
            'moduletype' => 1
        ]);
        DB::table('modules')->insert([
            'id' => 3,
            'name' => '系统分析',
            'moduletype' => 1
        ]);
        DB::table('modules')->insert([
            'id' => 4,
            'name' => '系统设置',
            'moduletype' => 1
        ]);
        DB::table('modules')->insert([
            'id' => 5,
            'name' => '在线客服',
            'moduletype' => 2
        ]);
        DB::table('modules')->insert([
            'id' => 6,
            'name' => '机器人客服',
            'moduletype' => 2
        ]);
        DB::table('modules')->insert([
            'id' => 7,
            'name' => '客户中心',
            'moduletype' => 2
        ]);
        DB::table('modules')->insert([
            'id' => 8,
            'name' => '工单系统',
            'moduletype' => 2
        ]);
        DB::table('modules')->insert([
            'id' => 9,
            'name' => '短信中心',
            'moduletype' => 2
        ]);
        DB::table('modules')->insert([
            'id' => 10,
            'name' => '呼叫中心',
            'moduletype' => 2
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            'id' => 1,
            'title' => '首页',
            'icon' => 'el-icon-fa-home',
            'path' => '/'
        ]);
        DB::table('menus')->insert([
            'id' => 2,
            'title' => '用户中心',
            'icon' => 'el-icon-fa-user',
            'path' => '/user'
        ]);
        DB::table('menus')->insert([
            'id' => 3,
            'title' => '在线客服',
            'icon' => 'el-icon-fa-comment',
            'path' => '/chat'
        ]);
        DB::table('menus')->insert([
            'id' => 4,
            'title' => '客服机器人',
            'icon' => 'el-icon-fa-android',
            'path' => '/robot'
        ]);
        DB::table('menus')->insert([
            'id' => 5,
            'title' => '客户中心',
            'icon' => 'el-icon-fa-users',
            'path' => '/customer'
        ]);
        DB::table('menus')->insert([
            'id' => 6,
            'title' => '工单系统',
            'icon' => 'el-icon-fa-th',
            'path' => '/order'
        ]);
        DB::table('menus')->insert([
            'id' => 7,
            'title' => '短信中心',
            'icon' => 'el-icon-fa-envelope',
            'path' => '/message'
        ]);
        DB::table('menus')->insert([
            'id' => 8,
            'title' => '呼叫中心',
            'icon' => 'el-icon-fa-phone',
            'path' => '/call'
        ]);
        DB::table('menus')->insert([
            'id' => 9,
            'title' => '统计分析',
            'icon' => 'el-icon-fa-pie-chart',
            'path' => '/analysis'
        ]);
        DB::table('menus')->insert([
            'id' => 10,
            'title' => '系统设置',
            'icon' => 'el-icon-setting',
            'path' => '/setting'
        ]);
        
    }
}

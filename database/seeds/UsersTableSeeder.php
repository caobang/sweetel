<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            'id' => 1,
            'name' => '甜心客服'
        ]);

        DB::table('robots')->insert([
            'id' => 1,
            'nickname' => '客服机器人',
            'team_id' => 1
        ]);

        DB::table('users')->insert([
            'id' => 1,
            'name' => 'caobang',
            'email' => '602098328@qq.com',
            'password' => bcrypt('111111'),
            'team_id' => 1,
            'role_id' => 1,
            'group_id' => 1
            //'chatgroup_id' => 2
        ]);
        DB::table('groups')->insert([
            'id' => 1,
            'name' => '默认分组',
            'grouptype' => 1,
            'team_id' => 1
        ]);
        DB::table('groups')->insert([
            'id' => 2,
            'name' => '默认分组',
            'grouptype' => 2,
            'team_id' => 1
        ]);
        DB::table('groups')->insert([
            'id' => 3,
            'name' => '默认分类',
            'grouptype' => 3,
            'team_id' => 1
        ]);
        DB::table('groups')->insert([
            'id' => 4,
            'name' => '默认分组',
            'grouptype' => 4,
            'team_id' => 1
        ]);
        DB::table('groups')->insert([
            'id' => 5,
            'name' => '默认分类',
            'grouptype' => 5,
            'team_id' => 1
        ]);
        DB::table('chatgroupusers')->insert([
            'group_id' => 2,
            'user_id' => 1
        ]);
    }
}

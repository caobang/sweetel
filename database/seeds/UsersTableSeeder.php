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
            'role_id' => 1
        ]);

        DB::table('groupusers')->insert([
            'group_id' => 1,
            'user_id' => 1
        ]);
        //DB::table('groupusers')->insert([
        //    'group_id' => 2,
        //    'user_id' => 1
        //]);
    }
}

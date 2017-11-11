<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'name' => '默认分组',
            'grouptype' => 1,
            'team_id' => 0
        ]);
        DB::table('groups')->insert([
            'name' => '默认分组',
            'grouptype' => 2,
            'team_id' => 0
        ]);
        DB::table('groups')->insert([
            'name' => '默认分类',
            'grouptype' => 3,
            'team_id' => 0
        ]);
        DB::table('groups')->insert([
            'name' => '默认分组',
            'grouptype' => 4,
            'team_id' => 0
        ]);
        DB::table('groups')->insert([
            'name' => '默认分类',
            'grouptype' => 5,
            'team_id' => 0
        ]);
    }
}

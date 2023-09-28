<?php

namespace Database\Seeders;

use DB;
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
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'mr.admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),


        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'mr.editor',
            'email' => 'editor@gmail.com',
            'password' => bcrypt('12345678'),


        ]);


    }
}
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
        DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'mobile' => '01012316954',
                'address' => 'admin',
                'gender' => 'admin',
                'password' => bcrypt('password'),
        ]);

        DB::table('permissions')->insert([
            'name' => 'department',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
            'name' => 'warehouse',
            'guard_name' => 'web',
        ]);
    }
}

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
        DB::table('users')->insert(
            [
                'name' => 'Admin',
                'surname' => 'Admin',
                'email' => 'admin@admin.com',
                'banned' => false,
                'role-id' => 1,
                'password' => bcrypt(env('ADMIN_PASS')),
            ]
        );
    }
}

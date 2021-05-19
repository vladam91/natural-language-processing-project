<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
        [
            'type' => 'admin',
        ]
        );

        DB::table('roles')->insert(
            [
                'type' => 'moderator',
            ]
        );

        DB::table('roles')->insert(
            [
                'type' => 'autor',
            ]
        );

        DB::table('roles')->insert(
            [
                'type' => 'subscriber',
            ]
        );

        DB::table('roles')->insert(
            [
                'type' => 'user',
            ]
        );
    }
}

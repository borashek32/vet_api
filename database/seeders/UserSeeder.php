<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'      => 'Nataly Zueva',
                'email'     => '111@inbox.ru',
                'password'  => Hash::make('11111111')
            ],
            [
                'name'      => 'Vadim Zuev',
                'email'     => '222@inbox.ru',
                'password'  => Hash::make('22222222')
            ]
        ]);
    }
}

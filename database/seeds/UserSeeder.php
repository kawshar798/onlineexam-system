<?php

use Illuminate\Database\Seeder;
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
        //
        DB::table('users')->insert([
            'first_name' => 'Mr',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'isAdmin' => 1,
            'password' => Hash::make('password'),
        ]);
    }
}

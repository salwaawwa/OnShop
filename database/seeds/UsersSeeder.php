<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'	=> 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'admin' => '1'
        ]);
    }
}

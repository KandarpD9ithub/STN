<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  => 'admin',
            'email' => 'admin@admin.com',
            'role_id'  => 1,
            'print_marketing_version' => 1,
            'password'  => \Hash::make(123456),
            'api_token' => str_random(60),
        ]);
    }
}

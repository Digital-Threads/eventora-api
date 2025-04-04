<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Infrastructure\Eloquent\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->firstOrCreate([
            'first_name' => 'Test',
            'last_name' => 'Test',
            'email' => 'test@finance.test',
            'password' => Hash::make('password'),
            'registered_at' => now(),
            'role_id' => 1,
        ]);
    }
}

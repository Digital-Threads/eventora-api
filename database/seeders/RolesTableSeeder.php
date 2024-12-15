<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Infrastructure\Eloquent\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultRoles = [
            [
                'name' => 'Adin',
            ],
            [
                'name' => 'User',
            ],
        ];

        foreach($defaultRoles as $role){
            Role::query()->firstOrCreate($role);
        }
    }
}

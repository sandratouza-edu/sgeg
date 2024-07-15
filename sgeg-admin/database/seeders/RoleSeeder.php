<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'id' => 1,
            'name' => 'PDI'
        ]);
        Role::create([
            'id' => 2,
            'name' => 'student'
        ]);
        Role::create([
            'id' => 3,
            'name' => 'doctor'
        ]);
        Role::create([
            'id' => 4,
            'name' => 'speaker'
        ]);
        Role::create([
            'id' => 5,
            'name' => 'guest'
        ]);
    }
}

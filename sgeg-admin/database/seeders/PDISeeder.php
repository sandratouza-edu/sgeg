<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pdi;
use App\Models\User;


class PDISeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pdi::factory()->count(2)->create();

        $pdi = User::create([
            'name' => 'pdi',
            'email' => 'pdi@example.com',
            'password' => Hash::make('password'),
        ]);
        $pdi->assignRole('pdi');

        Pdi::create( [
            'degree' => 1,
            'thesis_date' => fake()->date(),
            'user_id' => $pdi->id,  
        ]);

    }
}

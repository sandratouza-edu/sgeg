<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\PDI;

class PDISeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PDI::factory()->count(20)->create();
    }
}

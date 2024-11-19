<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Degree;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     
        Degree::create([
                'name' => 'GREI',
                'color' => '#ffee22',
                'description' => 'Grado en Ingeniería Informática ',
                'active' => true,
        ]);
        Degree::create([
            'name' => 'GRIA',
            'color' => '##FFDF00',
            'description' => 'Grado en Inteligencia Artificial',
            'active' => true,
        ]);
        Degree::create([
            'name' => 'PCEO',
            'color' => '##FFDF00',
            'description' => 'Grado en ADE + Grado en Ingeniería Informática',
            'active' => true,
        ]);
        Degree::create([
            'name' => 'PARS',
            'color' => '##FFDF00',
            'description' => 'Grado y Máster en Ingeniería Informática',
            'active' => true,
        ]);
        Degree::create([
            'name' => 'MEI',
            'color' => '#ffee22',
            'description' => 'Máster Universitario en Ingeniería Informática ',
            'active' => true,
        ]);
        Degree::create([
            'name' => 'MAI',
            'color' => '#ffee22',
            'description' => 'Máster Universitario en Inteligencia Artificial',
            'active' => true,
        ]);
        Degree::create([
            'name' => 'Fisica',
            'color' => '#5DC1B9',
            'description' => 'Grado en Física',
            'active' => false,
        ]);
        Degree::create([
            'name' => 'Matemáticas',
            'color' => '#55B4B0',
            'description' => 'Grado en Matemáticas',
            'active' => false,
        ]);

    }
}


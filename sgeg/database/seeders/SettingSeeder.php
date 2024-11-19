<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $keys = [ 'site_name','sender_name', 'admin_email', 'telegram_token', 'telegram_channel', 'pagination',
                    'col_name', 'col_email', 'col_phone', 'col_phone2', 'col_dni'];
        
        $settings = [
            ['key' => 'site_name', 'value' => 'SGEG'],
            ['key' => 'description', 'value' => 'Sistema gestor de Eventos de Graduación'],
            ['key' => 'admin_email', 'value' => 'sgeg@sgeg.touzaprojects.com'],
            ['key' => 'sender_name', 'value' => 'sgeg.com'],
            ['key' => 'pagination', 'value' => 10],
            ['key' => 'col_name', 'value' => 'nombre'],
            ['key' => 'col_dni', 'value' => 'dni'],
            ['key' => 'col_email', 'value' => 'email'],
            ['key' => 'col_phone', 'value' => 'telefono'],
            ['key' => 'col_phone2', 'value' => 'telefono2'],
            ['key' => 'telegram_token', 'value' => 'telegram_token'],
            ['key' => 'telegram_channel', 'value' => 'sgeg24'],
            ['key' => 'paper', 'value' => 'letter'],
            ['key' => 'orientation', 'value' => 'orientation'],
        ];
 
        Setting::insert($settings);
        
    }
}

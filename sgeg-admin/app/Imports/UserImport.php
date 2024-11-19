<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use App\Models\Setting;

class UserImport implements ToModel, WithHeadingRow
{   
    protected $data;
    public function __construct(array $data) 
    {
        $this->data = $data;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        //get column names from settings 
        $settings = Setting::get(['key', 'value']);
        $config =[];
        
        foreach ($settings as $setting) {
            $config[$setting->key] = $setting->value;
        }
        try {
            $rowname = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', strtolower(iconv("UTF-8", "ISO-8859-1//IGNORE", $config['col_name']))));
            $rowemail = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', strtolower(iconv("UTF-8", "ISO-8859-1//IGNORE", $config['col_email']))));
            $rowphone = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', strtolower(iconv("UTF-8", "ISO-8859-1//IGNORE", $config['col_phone']))));
            $rowdni = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', strtolower(iconv("UTF-8", "ISO-8859-1//IGNORE", $config['col_dni']))));

            $phones = explode("/", $row[$rowphone]);
            
            $user = new User([
                'name' => iconv("UTF-8", "ISO-8859-1//IGNORE", $row[$rowname]),
                'email' => iconv("UTF-8", "ISO-8859-1//IGNORE", $row[$rowemail]),
                'dni' => iconv("UTF-8", "ISO-8859-1//IGNORE", $row[$rowdni]),
                'phone' => iconv("UTF-8", "ISO-8859-1//IGNORE",  $phones[0]),
                //add +34 - if dont have
                'phone2' => iconv("UTF-8", "ISO-8859-1//IGNORE", array_key_exists(1, $phones)? $phones[1]:null ),
                'email_verified_at' => now(),
                'degree_id' => $this->data['degree'],
                'password' =>  Hash::make('password')
            ]);

            $user->assignRole($this->data['role']);

            return $user;
        } catch (\Exception $e) {
           // dd('Error importing users');
        }
    }
}
/* 
     ["apellidos_y_nombre"]=>
     ["dni"]=>
     ["direccin_electrnica"]=>
     ["fecha_nacimiento"]=>
     ["telfono_habitual"]=>
     ["direccin_durante_el_curso"]=>
     ["telfono_durante_el_curso"]=>
     ["grupo_de_matrcula"]=>
     ["plan_del_estudiante"]=>
     ["fecha_de_matrcula"]=>
  */
  
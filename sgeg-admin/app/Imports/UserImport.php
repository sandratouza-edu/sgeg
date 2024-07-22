<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UserImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

// Apellidos y nombre	D.N.I.	N.I.A.	Direcci�n electr�nica	Fecha nacimiento	G�nero	Direcci�n habitual	Tel�fono habitual	Direcci�n durante el curso		Tel�fono durante el curso					Veces. Matri.			Conv. Cons.			As/Cr Matri.			As/Cr Super.			R�gimen permanencia			Grupo de matr�cula			Plan del estudiante			Fecha de matr�cula
//AGUL GEZ, Iria   49682422P	273318		lia.aglo@alumnado.uvigo.gal	22/08/04	Urb. Aguas Mansas. R�a R�o Sil, 32, 15174 - Acea de Ama	698132558�/�619050347					Urb. Aguas Mansas. R�a R�o Sil, 32, 15174 - Acea de Ama											698132558�/�619050347					1			0			66			42			0-Tiempo Completo			52684Redes - 1-			11395-O06G460V01 G.  Inteligencia Arti			04-09-2023



        $user = new User([
            'name' => $row['nombre'],
            'email' => $row['email'],
            'dni' => $row['dni'],
            'phone' => $row['telefono'],
            'email_verified_at' => now(),
            'password' =>  Hash::make('password')
        ]);
        $user->assignRole(2);

        return $user;
    }
}

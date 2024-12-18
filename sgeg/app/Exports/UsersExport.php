<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Spatie\Permission\Models\Role;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return User::all(); // filter by role and degree
        $users = User::role('student')->get();
        return $users;
    }
}

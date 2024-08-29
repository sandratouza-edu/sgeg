<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;


class CsvController extends Controller
{
    public function index($filter=null) {

        $users = User::with('roles')->get();
        return view('actions.index', compact('users'));
    }
    
    public function import(Request $request) {
        //Hacer una custom request para validar
        //sustituir lo que validamos aquí
        $request->validate([
            'document_csv' => 'required' //|mimes:csv,xls,xlsx|max:2048'
        ]);
        try {
            $file = $request->file('document_csv');
            $data['role'] = 2; // $request->role;
            $data['degree'] = 1; //$request->degree;
            Excel::import(new UserImport($data), $file);
            return redirect()->route('index');

        } catch (\Exception $e) {
             return redirect()->route('index');
            // dd('Error importing users');
        }
        
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'alumnos-'.date('Y-m-d').'.csv');
    }
}
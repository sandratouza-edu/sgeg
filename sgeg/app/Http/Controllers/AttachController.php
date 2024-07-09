<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;


use Illuminate\Http\Request;

class AttachController extends Controller
{
    public function invite()
    {
        //$pdf = Pdf::loadView('pdf.attach');
        $data = ['name' => "Sandra"];
        $pdf = Pdf::setPaper('letter', 'landscape')->loadView('pdf.letter', $data);
       // $pdf->save('myAttahc.pdf');
       
        return $pdf->download('myinvite.pdf');
    }
}

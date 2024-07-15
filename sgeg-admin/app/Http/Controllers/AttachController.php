<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Attach;

class AttachController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $attachs = Attach::all();
        return view('attach.index', compact('attachs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('attach.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Attach::create($request->all());
        
        return redirect()->route('attach.index')->with('success', 'Attach Created');

    }

    public function invite()
    {
        //$pdf = Pdf::loadView('pdf.attach');
        $data = ['name' => "Sandra"];
        $pdf = Pdf::setPaper('letter', 'landscape')->loadView('pdf.letter', $data);
       // $pdf->save('myAttahc.pdf');
       
        return $pdf->download('myinvite.pdf');
    }
}

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
   
        $data = $request->all();
        $uri = ucwords(str_replace(' ', ' ', $request['name'])).'.pdf';
        $data['uri'] = asset('/doc/'.$uri);
        
        $pdf = Pdf::setPaper('letter', 'landscape')->loadView('pdf.letter', $data);
        $pdf->save($uri);
      
        Attach::create($data);

        return redirect()->route('attach.index')->with('success', 'Document Created');


    }

    /**
     * Display the specified resource.
     */
    public function show(Attach $attach): View
    {
        return view('attach.show', compact('attach'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attach $attach): View
    {
        return view('attach.edit', compact('attach'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attach $attach): RedirectResponse
    {
        $attach->update($request->all()); 
         
     
        return redirect()->route('attach.edit', $attach)->with('message', __('Doc Updated'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Attach $attach): RedirectResponse
    {
        $attach->delete();

        return redirect()->route('attach.index')->with('danger', 'attach Deleted');
    
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

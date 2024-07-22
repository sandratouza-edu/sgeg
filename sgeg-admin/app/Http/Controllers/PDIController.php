<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\PDI;
use App\Models\User;
use App\Http\Requests\PDIRequest;
use Spatie\Permission\Models\Role;

class PDIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $pros = PDI::all();
        $pdis = User::role('pdi')->with('pdi')->get(); 
         
        return view('pdi.index', compact('pdis', 'pros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pdi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PDIRequest $request): RedirectResponse
    {
        PDI::create($request->all());
        
        //return redirect()->route('pdi.index')->with('success', 'pdi Created');
        return back()->with('success');

    }

    /**
     * Display the specified resource.
     */
    public function show(PDI $pdi): View
    {
        
        return view('pdi.show', compact('pdi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PDI $pdi): View
    {
        //$pdi = PDI::with('users')->find($pdi->id);

        return view('pdi.edit', compact('pdi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PDIRequest $request, PDI $pdi): RedirectResponse
    {
        $pdi->update($request->all()); 

        return redirect()->route('pdi.index')->with('success', 'pdi Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, PDI $pdi): RedirectResponse
    {
        $pdi->delete();

        return redirect()->route('pdi.index')->with('danger', 'pdi Deleted');
    
    }
}

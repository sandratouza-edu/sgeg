<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Garment;
use App\Models\GarmentUser;
use App\Models\User;
use App\Models\Pdi;
use App\Http\Requests\GarmentRequest;
class GarmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $garments = Garment::with('user')->get();

        return view('garment.index', compact('garments'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $owners = User::role('pdi')->with('pdi')->get(); 
        
        return view('garment.create', compact('owners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GarmentRequest $request): RedirectResponse
    {
        Garment::create($request->all());
        
        return redirect()->route('garment.index')->with('success', 'garment Created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Garment $garment): View
    {

        return view('garment.show', compact('garment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Garment $garment): View
    {
        $owners = User::role('pdi')->with('pdi')->get(); 
        
        return view('garment.edit', compact('garment', 'owners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GarmentRequest $request, Garment $garment): RedirectResponse
    {
       
        
        $garment->update($request->all()); 

        return redirect()->route('garment.index')->with('success', 'garment Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Garment $garment): RedirectResponse
    {
        $garment->delete();

        return redirect()->route('garment.index')->with('danger', 'garment Deleted');
    
    }

    /**
     * Show the form  borrowing the garment.
     */

    public function borrow(Garment $garment): View
    {
        $pdis = User::role('pdi')->with('pdi')->get(); 
        
        $garments = Garment::with('users')->get();
 
        return view('garment.borrow', compact('garment', 'garments',  'pdis'));
    }

    /**
     * Save borrowing the garment.
     */
    public function borrowSave(Request $request): RedirectResponse
    {
         
        GarmentUser::create($request->all());
        return redirect()->route('garment.index')->with('success', 'garment Updated');
    }

    /**
     * Show the request list to lend the garment.
     */
    public function lend(Garment $garment): View
    {
        //$list = GarmentUser::get();
        $garments = Garment::with('pdi')->get();
        $pdis = User::role('pdi')->with('pdi')->get(); 
        
        return view('garment.lend', compact('garments',  'pdis', 'garment'));
    }

}

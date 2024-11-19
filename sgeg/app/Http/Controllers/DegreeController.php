<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Degree;

class DegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $degrees = Degree::all();
        return view('degree.index', compact('degrees'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('degree.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Degree::create($request->all());
        
        return redirect()->route('degree.index')->with('success', 'degree Created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Degree $degree): View
    {
        return view('degree.show', compact('degree'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Degree $degree): View
    {
        return view('degree.edit', compact('degree'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Degree $degree): RedirectResponse
    {
        $degree->update($request->all()); 

        return redirect()->route('degree.index')->with('success', 'degree Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Degree $degree): RedirectResponse
    {
        $degree->delete();

        return redirect()->route('degree.index')->with('danger', 'degree Deleted');
    
    }
}

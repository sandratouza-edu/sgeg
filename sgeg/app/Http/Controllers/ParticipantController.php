<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Participant;
use App\Http\Requests\ParticipantRequest;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $participants = Participant::all();
        return view('participant.index', compact('participants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('participant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParticipantRequest $request): RedirectResponse
    {
        Participant::create($request->all());
        
        return redirect()->route('participant.index')->with('success', 'Participant Created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Participant $participant): View
    {
        return view('participant.show', compact('participant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participant $participant): View
    {
        return view('participant.edit', compact('participant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParticipantRequest $request, Participant $participant): RedirectResponse
    {
        $participant->update($request->all()); 

        return redirect()->route('participant.index')->with('success', 'participant Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Participant $participant): RedirectResponse
    {
        $participant->delete();

        return redirect()->route('participant.index')->with('danger', 'participant Deleted');
    
    }
}

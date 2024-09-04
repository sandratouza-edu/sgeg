<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\SeatUser;
use App\Models\User;
class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //    $users = User::with('seat')->get();
        $user = User::find(290);
        $seats = Seat::all();
       // $seats = User::with('user')->get();
        
        return view('actions.reserve', compact('user', 'seats'));
    }

    

    public function staircase()
    {
    //    $users = User::with('seat')->get();
        
        $seats = Seat::all();
       // $seats = User::with('user')->get();
        
        return view('actions.staircase', compact('seats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
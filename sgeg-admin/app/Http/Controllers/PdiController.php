<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\Pdi;
use App\Models\User;
use App\Models\Degree;
use App\Http\Requests\PdiRequest;
use Spatie\Permission\Models\Role;

class PdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $pdis = Pdi::with('user')->get();
       
        return view('pdi.index', compact('pdis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $degrees = Degree::all();
        return view('pdi.create',compact('degrees')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        //ver uso $request->only('email','password')

        if(empty($input['password'])){ 
            $input['password'] = Hash::make('password');
        } else {
            $input['password'] = Hash::make($input['password']);
        }

        $user = User::create($input);
         
        $pdi = Pdi::create([
            'thesis_date' => $request->thesis_date,
            'degree' => $request->degree,
            'user_id' => $user->id
        ]);
        
        $user->assignRole($request->role);
    
        return redirect()->route('pdi.index')->with('success', 'pdi Updated');

    }

    /**
     * Display the specified resource.
     */
    public function show(Pdi $pdi): View
    {
        $degrees = Degree::all();
        return view('pdi.show', compact('pdi', 'degrees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pdi $pdi): View
    {
        $pdi = Pdi::with('user')->find($pdi->id);
        $degrees = Degree::all();

        return view('pdi.edit', compact('pdi', 'degrees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pdi $pdi): RedirectResponse
    {
    
        $pdi->thesis_date = $request->thesis_date;
        $pdi->degree      = $request->degree_id;
        //$pdi->is_godfather
        $pdi->save(); 

        $user = User::find($pdi->user_id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email =  $request->email;
        $user->save();

       return redirect()->route('pdi.index')->with('success', 'pdi Updated');
        //return redirect()->route('pdi.edit', $pdi)->with('message', __('Updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Pdi $pdi): RedirectResponse
    {
        
        $pdi->delete();
        $user = User::find($pdi->user_id);
        $user->delete();
        return redirect()->route('pdi.index')->with('danger', 'pdi Deleted');
    
    }
}

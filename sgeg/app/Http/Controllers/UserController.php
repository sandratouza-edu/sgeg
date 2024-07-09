<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(env('ITEMS_PAGE') );
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        User::create($request->all());
        
        return redirect()->route('user.index')->with('success', 'user Created');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $user->update($request->all()); 

        return redirect()->route('user.index')->with('success', 'user Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('user.index')->with('danger', 'user Deleted');
    
    }

    public function indexAPI() {
        return User::paginate(15);
    }

    public function searchPost(Request $request) 
    {
        $request->validate([ 
           'name' => ['required', 'min:5', 'max:255'] 
        ], [
            // Custom message
            'name.required' => 'Can not be empty'
        ]);
        $users = User::where('name', 'LIKE', '%'.$request->name.'%')->paginate(env('ITEMS_PAGE') );

        return view ('user.index', compact('users'));
    }
}

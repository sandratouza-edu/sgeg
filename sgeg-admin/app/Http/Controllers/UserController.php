<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Pdi;
use App\Models\Degree;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function __construct() {
       // $this->middleware('can: adminall')->only('index');
     // $this->middleware('can: edit user')->only('edit');
    // $this->middleware(['permission:read|edit|delete']);
    /*
        $this->middleware(['permission:product-list|product-create|product-edit|product-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:product-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:product-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:product-delete'], ['only' => ['destroy']]);
    */

    }
     /**
     * Render list of users.
     */
    public function index(): View
    {
        $users = User::with('roles')->with('degree')->get();
        
        return view('user.index', compact('users'));
    }

    /**
     * Render list of students.
     */
    public function list(String $filter = 'student'): View
    {
        
        $users = User::role($filter)->get();

        //$degrees = Degree::where('active', '1')->get();

        return view('user.index', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::all();
        $degrees = Degree::all();
        return view('user.create',compact('roles', 'degrees')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        
        $input = $request->all();
        if(empty($input['password'])){ 
            $input['password'] = Hash::make('password');
        } else {
            $input['password'] = Hash::make($input['password']);
        }
        
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        if(in_array('pdi', $request->roles)) {
            $pdi = Pdi::create(['user_id' => $user->id]);
        }

        
        return redirect()->route('user.index')->with('success', 'user Created');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        $degrees = Degree::all();
        return view('user.show', compact('user','degrees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        $roles = Role::all();
        $degrees = Degree::all();
        return view('user.edit', compact('user', 'roles', 'degrees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $user->update($request->all()); 
        /*
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);

        */
        $user->roles()->sync($request->roles);

        return redirect()->route('user.edit', $user)->with('message', __('User Updated'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        $user->delete();

        //return redirect()->route('user.index')->with('danger', 'user Deleted');
        return back()->with('danger', 'user Deleted');
    
    }

    public function multiDestroy(Request $request, User $user): Response
    {
        
        User::whereIn('id', $request->get('selected'))->delete();

        return response("Selected users deleted successfully.", 200);
    
    }
}
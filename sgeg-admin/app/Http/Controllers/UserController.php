<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;
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
    public function index(): View
    {
        $users = User::with('roles')->get();
        
        return view('user.index', compact('users'));
    }

    public function list(String $filter = 'student'): View
    {
        $users = User::role($filter)->get();
     //  $users = User::with('roles')->get();
        return view('user.index', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        $roles = Role::all();
        return view('user.create',compact('roles')); 
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
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
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

    public function indexAPI() {
        return User::paginate(15);
    }

    public function searchPost(Request $request): View
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

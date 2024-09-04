<?php

namespace App\Http\Controllers;

//use App\Models\Role;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $roles = Role::all();
        return view('user.roles', compact('roles'));
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
    public function store(Request $request): RedirectResponse
    {
        $role = Role::create(['name' => $request->input('name')]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource 
     * and assigned permissions
     */
    public function edit(Role $role): View
    {
        
        $permissions = Permission::all();
        
        return view('user.role-edit', compact('role', 'permissions'));

    }

    /**
     * Update the specified resource in storage.  roles and permissions
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        //Se utiliza la relación para hacer las modificaciones de la tabla que relaciona roles y permisos

        $role->permissions()->sync($request->permissions);

        return redirect()->route('role.edit', $role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Role $role): RedirectResponse
    {
        $role->delete();

        return redirect()->route('role.index')->with('danger', __('Deleted ok'));
    }
}

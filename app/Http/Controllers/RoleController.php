<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct() {
        $this->middleware('can:roles.create')->only('create', 'store');
        $this->middleware('can:roles.read')->only('index', 'show');
        $this->middleware('can:roles.update')->only('edit', 'update');
        $this->middleware('can:roles.delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create () {
        $permissions = Permission::all();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = ['name' => 'required|string|unique:roles,name'];
        $message = [
            'name.required' => 'Role name cannot be empty',
            'name.string'   => 'Role name has to be a character string',
            'name.unique'   => 'Role name already exists'
        ];
        request()->validate($rules, $message);

        $role = Role::create($request->all());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.edit', compact('role'))
            ->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);

        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role) {
        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role) {   
        $message = ['name.required' => 'Role name cannot be empty.'];
        request()->validate(['name' => 'required'], $message);

        $role->update($request->all());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index', compact('role'))
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role) {   
        $role->delete();

        return redirect()->route('roles.index', compact('role'))
            ->with('success', 'Role deleted successfully.');
    }
}
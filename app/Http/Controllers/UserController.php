<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    public function __construct() {
        $this->middleware('can:users.create')->only('create', 'store');
        $this->middleware('can:users.read')->only('index');
        $this->middleware('can:users.update')->only('edit', 'update');
        $this->middleware('can:users.delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $roles = Role::all();
        return view('user.create', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(User::$rules, User::$message);

        $request['password']=Hash::make($request['password']); //Se guarda la contraseña encriptada
        $user = User::create($request->all());

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('user.edit', compact('user', 'roles'));
    }
    public function editSelf()
    {
        $user = User::find(auth()->user()->id);

        return view('user.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        request()->validate(array_slice(User::$rules, 1), User::$message);
        request()->validate(['email' => 'required|string'], User::$message);

        $request['password']=Hash::make($request['password']); //Se guarda la contraseña encriptada
        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }
    public function updateSelf(Request $request)
    {
        request()->validate(array_slice(User::$rules, 1), User::$message);
        request()->validate(['email' => 'required|string'], User::$message);

        $request['password']=Hash::make($request['password']); //Se guarda la contraseña encriptada
        
        User::find(auth()->user()->id)->update($request->all());

        return redirect()->route('home')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function assign($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('user.assign', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function updateRole(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);

        return redirect()->route('users.index')
            ->with('success', 'Role assigned successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}

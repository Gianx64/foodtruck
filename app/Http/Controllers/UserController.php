<?php

namespace App\Http\Controllers;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    public function __construct() {
        $this->middleware('can:users.read')->only('index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('self-update');
    }
}

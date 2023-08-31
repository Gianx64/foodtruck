<?php

namespace App\Http\Controllers;

class RoleController extends Controller
{
    public function __construct() {
        $this->middleware('can:roles.read')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('livewire.roles.index');
    }
}
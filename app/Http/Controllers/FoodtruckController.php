<?php

namespace App\Http\Controllers;

class FoodtruckController extends Controller
{
    public function __construct() {
        $this->middleware('can:foodtrucks.read')->only('index','documentsIndex','namesIndex');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('livewire.applications.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function documentsIndex() {
        return view('livewire.documents.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function namesIndex() {
        return view('livewire.names');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Foodtruck;
use Illuminate\Http\Request;

class FoodtruckController extends Controller
{
    public function __construct() {
        $this->middleware('can:foodtrucks.read')->only('index','foodIndex');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('livewire.foodtrucks.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function foodIndex() {
        return view('foodtypes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function create ($id) {
        return view('foodtruck-apply', compact('id'));
    }
}
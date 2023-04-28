<?php

namespace App\Http\Controllers;

use App\Models\Foodtruck;
use Illuminate\Http\Request;

class FoodtruckController extends Controller
{
    public function __construct() {
        $this->middleware('can:foodtrucks.read')->only('index','show');
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
     * Show the form for creating a new resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function create ($id) {
        $foodtruck = new Foodtruck();
        $foodtruck->event_id = $id;

        return view('foodtruck-apply', compact('foodtruck'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        request()->validate(Foodtruck::$rules, Foodtruck::$message);

        $foodtruck = Foodtruck::create($request->all());

        return redirect()->route('events.show', $foodtruck->event_id)
            ->with('success', 'Foodtruck applied successfully.');
    }
}
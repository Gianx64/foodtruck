<?php

namespace App\Http\Controllers;

use App\Models\Foodtruck;
use Illuminate\Http\Request;

class FoodtruckController extends Controller
{
    public function __construct() {
        //$this->middleware('can:foodtrucks.create')->only('create', 'store');
        $this->middleware('can:foodtrucks.read')->only('index','show');
        $this->middleware('can:foodtrucks.update')->only('edit', 'update');
        $this->middleware('can:foodtrucks.delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $foodtrucks = Foodtruck::all();

        return view('foodtrucks.index', compact('foodtrucks'));
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

        return view('foodtrucks.create', compact('foodtruck'));
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

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $foodtruck = Foodtruck::find($id);

        return view('foodtrucks.show', compact('foodtruck'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $foodtruck = Foodtruck::find($id);

        return view('foodtrucks.edit', compact('foodtruck'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Foodtruck $foodtruck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foodtruck $foodtruck) {
        request()->validate(Foodtruck::$rules, Foodtruck::$message);

        $foodtruck->update($request->all());

        return redirect()->route('foodtrucks.index')
            ->with('success', 'Foodtruck updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Foodtruck $foodtruck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Foodtruck $foodtruck) {
        $foodtruck->delete();

        return redirect()->route('foodtrucks.index')
            ->with('success', 'Foodtruck deleted successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function accept($id) {
        $foodtruck = Foodtruck::find($id);
        $accepted = $foodtruck->replicate();
        $accepted->setTable('foodtrucks_accepted');
        $accepted->save();
        $foodtruck->delete();

        return redirect()->route('foodtrucks.index')
        ->with('success', 'Foodtruck accepted successfully.');
    }
}
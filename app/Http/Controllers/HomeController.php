<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Foodtruck;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $data = [Event::all()->count(), Event::all()->where('date', '>', date("Y-m-d"))->count(), Foodtruck::all()->count()];

        return view('home', compact('data'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Document;
use App\Models\Event;
use App\Models\User;

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
        $data = [Event::all()->where('date', '>', date("Y-m-d"))->count(), Application::where('approved', 0)->count(), Document::where('approved', 0)->count()];
        /*$user = User::find(auth()->user()->id);
        if($user->hasRole('Administrator'))
            $data = [User::count(), Event::all()->where('date', '>', date("Y-m-d"))->count(), Application::where('approved', 0)->count()];
*/
        return view('home', compact('data'));
    }
}

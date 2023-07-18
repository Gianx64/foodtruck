<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class EventController
 * @package App\Http\Controllers
 */
class EventController extends Controller
{
    public function __construct() {
        $this->middleware('can:events.read')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('livewire.events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        $event->map = Storage::url($event-> map);
        $foodtrucks = DB::table('foodtrucks_applications')->where('event_id', $id)
        ->leftJoin('foodtrucks', 'foodtrucks_applications.foodtruck_id', 'foodtrucks.id')
        ->select('foodtrucks_applications.*', 'foodtrucks.plate', 'foodtrucks.foodtruck_name', 'foodtrucks.description')->get();
        $foodtrucks_approved = $foodtrucks->where('approved', 1);
        $foodtrucks_pending = $foodtrucks->where('approved', 0);
        if(auth()->user()){
            $hasfoodtruck = DB::table('foodtrucks')->where('user_id', auth()->user()->id)->exists();
            return view('livewire.events.show', compact('event', 'foodtrucks_approved', 'foodtrucks_pending', 'hasfoodtruck'));
        }

        return view('livewire.events.show', compact('event', 'foodtrucks_approved', 'foodtrucks_pending'));
    }
}
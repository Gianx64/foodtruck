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
        $event = Event::find($id);
        $event->map = Storage::url($event-> map);
        $foodtrucks = DB::table('foodtrucks_accepted')->where('event_id', $id)->get();

        return view('event-show', compact('event', 'foodtrucks'));
    }
}
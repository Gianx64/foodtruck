<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct() {
        //$this->middleware('can:events.create')->only('create', 'store');
        $this->middleware('can:events.read')->only('index');
        //$this->middleware('can:events.update')->only('edit', 'update');
        //$this->middleware('can:events.delete')->only('destroy');
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
        $foodtrucks = DB::table('foodtrucks_accepted')->where('event_id', $id)->get();

        return view('events.show', compact('event', 'foodtrucks'));
    }
}
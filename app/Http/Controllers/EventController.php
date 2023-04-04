<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct() {
        $this->middleware('can:events.create')->only('create', 'store');
        $this->middleware('can:events.read')->only('index');
        $this->middleware('can:events.update')->only('edit', 'update');
        $this->middleware('can:events.delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $events = Event::all();

        return view('Events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create () {
        $event = new Event();

        return view('events.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = ['name' => 'required|string|unique:events,name',
        //'map' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $message = [
            'name.required' => 'Event name cannot be empty',
            'name.string'   => 'Event name has to be a character string',
            'name.unique'   => 'Event name already exists'
        ];
        request()->validate($rules, $message);

        $event = Event::create($request->all());
        //$request->file('map')->move(public_path('images'), date('YmdHi').$request->name.'.'.$request->image->extension());

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "update";
        $event = Event::find($id);
        $foodtrucks = DB::table('foodtrucks_accepted')->where('event_id', $id)->get();

        return view('events.show', compact('event', 'foodtrucks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $event = Event::find($id);

        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event) {
        $message = ['name.required' => 'Event name cannot be empty.'];
        request()->validate(['name' => 'required'], $message);

        $event->update($request->all());

        return redirect()->route('events.index', compact('event'))
            ->with('success', 'Event updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event) {
        $event->delete();

        return redirect()->route('events.index', compact('event'))
            ->with('success', 'Event deleted successfully.');
    }
}
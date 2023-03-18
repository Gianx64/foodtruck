<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

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
        $permissions = Permission::all();

        return view('events.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = ['name' => 'required|string|unique:events,name'];
        $message = [
            'name.required' => 'Event name cannot be empty',
            'name.string'   => 'Event name has to be a character string',
            'name.unique'   => 'Event name already exists'
        ];
        request()->validate($rules, $message);

        $event = Event::create($request->all());
        $event->permissions()->sync($request->permissions);

        return redirect()->route('events.edit', compact('event'))
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
        $event = Event::find($id);

        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event) {
        $permissions = Permission::all();

        return view('events.edit', compact('event', 'permissions'));
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
        $event->permissions()->sync($request->permissions);

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
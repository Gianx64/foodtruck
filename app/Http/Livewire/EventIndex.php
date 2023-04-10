<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class EventIndex extends Component
{
    use WithPagination;

    //protected $paginationTheme = "bootstrap";

    public $search;

    public function updatingSearch() {
        $this->resetPage();
    }

    public function render()
    {
        $events = Event::where('name', 'like', '%' . $this->search . '%')
            ->orwhere('owner', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.event-index', compact('events'));
    }

    use WithFileUploads;

    public $name;
    public $date;
    public $image;
    public $owner;
    public $address;
    public $description;

    public function editEvent($id){
        $post = Event::findOrFail($id);
        $this->name = $post->name;
        $this->date = $post->date;
        $this->image = $post->image;
        $this->owner = $post->owner;
        $this->address = $post->address;
        $this->description = $post->description;

        $this->validate( Event::$rules, Event::$message );
        $this->image->store('public/events');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;
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
}

<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Events extends Component
{
    use WithFileUploads, WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $keyWord, $selected_id, $name, $name_old, $owner, $date, $address, $slots, $description, $dbmap, $map;

    public function render()
    {
        $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.events.view', [
            'events' => Event::latest()
                        ->orWhere('name', 'LIKE', $keyWord)
                        ->orWhere('owner', 'LIKE', $keyWord)
                        ->orWhere('date', 'LIKE', $keyWord)
                        ->orWhere('address', 'LIKE', $keyWord)
                        ->orWhere('description', 'LIKE', $keyWord)
                        ->paginate(10),
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->name = null;
        $this->name_old = null;
        $this->owner = null;
        $this->date = null;
        $this->address = null;
        $this->slots = null;
        $this->description = null;
        $this->dbmap = null;
        $this->map = null;
    }

    public function store()
    {
        $this->owner = auth()->user()->email;
        $this->validate(Event::$rules, Event::$message);

        $image = $this->map->storePublicly('public/eventmaps');
        Event::create([ 
            'name' => $this-> name,
            'owner' => $this-> owner,
            'date' => $this-> date,
            'address' => $this-> address,
            'slots' => $this-> slots,
            'description' => $this-> description,
            'map' => $image
        ]);
        
        $this->resetInput();
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('message', 'Event successfully created.');
    }

    public function edit($id)
    {
        $record = Event::findOrFail($id);
        $this->selected_id = $id; 
        $this->name = $record-> name;
        $this->name_old = $record-> name;
        $this->owner = $record-> owner;
        $this->date = $record-> date;
        $this->address = $record-> address;
        $this->slots = $record-> slots;
        $this->description = $record-> description;
        $this->dbmap = Storage::url($record-> map);
    }

    public function update()
    {
        if ($this->selected_id) {
            if ($this->name == $this->name_old)
                $this->validate(array_slice(Event::$rules, 1, 3), Event::$message);
            else
                $this->validate(array_slice(Event::$rules, 0, 4), Event::$message);
            $record = Event::find($this->selected_id);

            if ($this->map){
                $this->validate(
                    ['map' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'], Event::$message);
                $image = $this->map->storePublicly('public/eventmaps');
                $record->update([
                'name' => $this-> name,
                'owner' => $this-> owner,
                'date' => $this-> date,
                'address' => $this-> address,
                'slots' => $this-> slots,
                'description' => $this-> description,
                'map' => $image
                ]);
            } else
                $record->update([
                'name' => $this-> name,
                'owner' => $this-> owner,
                'date' => $this-> date,
                'address' => $this-> address,
                'slots' => $this-> slots,
                'description' => $this-> description
                ]);

            session()->flash('message', 'Event successfully updated.');
        }

        $this->resetInput();
        $this->dispatchBrowserEvent('closeModal');
    }

    public function destroy($id)
    {
        if ($id) {
            Event::where('id', $id)->delete();
            session()->flash('message', 'Event successfully deleted.');
        }
    }
}
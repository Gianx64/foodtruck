<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Events extends Component {
    use WithFileUploads, WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $keyWord, $selected_id, $document_list, $name, $name_old, $owner, $date, $address, $slots, $documents = [], $document, $description, $dbmap, $map;

    public function render() {
        $keyWord = '%'.$this->keyWord .'%';
        if(auth()->user())
            return view('livewire.events.view', [
                'events' => Event::latest()
                ->orWhere('name', 'LIKE', $keyWord)
                ->orWhere('owner', 'LIKE', $keyWord)
                ->orWhere('date', 'LIKE', $keyWord)
                ->orWhere('address', 'LIKE', $keyWord)
                ->orWhere('description', 'LIKE', $keyWord)
                ->paginate(10)
            ]);
        return view('livewire.events.view', [
            'events' => Event::orWhere('name', 'LIKE', $keyWord)
                ->where('date', '>=', date("Y-m-d"))
                ->orWhere('owner', 'LIKE', $keyWord)
                ->where('date', '>=', date("Y-m-d"))
                ->orWhere('date', 'LIKE', $keyWord)
                ->where('date', '>=', date("Y-m-d"))
                ->orWhere('address', 'LIKE', $keyWord)
                ->where('date', '>=', date("Y-m-d"))
                ->orWhere('description', 'LIKE', $keyWord)
                ->where('date', '>=', date("Y-m-d"))
                ->orderBy('date')->paginate(10)
            ]);
    }

    public function mount() {
        $this->document_list = DB::table('documentnames')->pluck('name')->toArray();
        if($this->document_list != '[]') {
            $this->document = $this->document_list[0];
        }
        if (auth()->user())
            $this->owner = auth()->user()->email;
    }

    public function cancel() {
        $this->resetInput();
    }

    private function resetInput() {
        $this->name = null;
        $this->name_old = null;
        $this->date = null;
        $this->address = null;
        $this->slots = null;
        $this->documents = [];
        $this->description = null;
        $this->dbmap = null;
        $this->map = null;
        if (auth()->user())
            $this->owner = auth()->user()->email;
        else
            $this->owner = null;
    }

    public function addName() {
        if(in_array($this->document, $this->documents))
            array_splice($this->documents, array_search($this->document, $this->documents), 1);
        else
            array_push($this->documents, $this->document);
    }

    public function store() {
        $this->owner = auth()->user()->email;
        $this->validate(Event::$rules, Event::$message);

        $image = $this->map->storePublicly('public/eventmaps');
        Event::create([ 
            'name' => $this-> name,
            'owner' => $this-> owner,
            'date' => $this-> date,
            'address' => $this-> address,
            'slots' => $this-> slots,
            'documents' => implode(', ', $this-> documents),
            'description' => $this-> description,
            'map' => $image
        ]);
        
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInput();
        session()->flash('message', 'Event successfully created.');
    }

    public function edit($id) {
        $record = Event::findOrFail($id);
        $this->selected_id = $id; 
        $this->name = $record-> name;
        $this->name_old = $record-> name;
        $this->owner = $record-> owner;
        $this->date = $record-> date;
        $this->address = $record-> address;
        $this->slots = $record-> slots;
        $this->documents = explode(', ', $record-> documents);
        $this->description = $record-> description;
        $this->dbmap = Storage::url($record-> map);
    }

    public function update() {
        if ($this->selected_id) {
            //hardcoded
            if ($this->name == $this->name_old)
                $this->validate(array_slice(Event::$rules, 1, 4), Event::$message);
            else
                $this->validate(array_slice(Event::$rules, 0, 5), Event::$message);
            $record = Event::findOrFail($this->selected_id);

            if ($this->map) {
                $this->validate(
                    ['map' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'], Event::$message);
                $image = $this->map->storePublicly('public/eventmaps');
                $record->update([
                'name' => $this-> name,
                'owner' => $this-> owner,
                'date' => $this-> date,
                'address' => $this-> address,
                'slots' => $this-> slots,
                'documents' => implode(', ', $this-> documents),
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
                'documents' => implode(', ', $this-> documents),
                'description' => $this-> description
                ]);

            session()->flash('message', 'Event successfully updated.');
        }

        $this->dispatchBrowserEvent('closeModal');
        $this->resetInput();
    }

    public function destroy($id) {
        $record = Event::findOrFail($id);
        if (file_exists(storage_path('app').'/'.$record->map))
            if(unlink(storage_path('app').'/'.$record->map)) {
                $record->delete();
                session()->flash('message', 'Event successfully deleted.');
            }
    }
}
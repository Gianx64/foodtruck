<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Event;

class Events extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $owner, $date, $address, $description;

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
		$this->owner = null;
		$this->date = null;
		$this->address = null;
		$this->description = null;
    }

    public function store()
    {
        $this->validate([
		'name' => 'required',
		'owner' => 'required',
		'date' => 'required',
		'address' => 'required',
        ]);

        Event::create([ 
			'name' => $this-> name,
			'owner' => $this-> owner,
			'date' => $this-> date,
			'address' => $this-> address,
			'description' => $this-> description
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Event Successfully created.');
    }

    public function edit($id)
    {
        $record = Event::findOrFail($id);
        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->owner = $record-> owner;
		$this->date = $record-> date;
		$this->address = $record-> address;
		$this->description = $record-> description;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
		'owner' => 'required',
		'date' => 'required',
		'address' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Event::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'owner' => $this-> owner,
			'date' => $this-> date,
			'address' => $this-> address,
			'description' => $this-> description
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Event Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Event::where('id', $id)->delete();
        }
    }
}
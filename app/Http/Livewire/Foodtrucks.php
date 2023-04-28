<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Foodtruck;

class Foodtrucks extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $keyWord, $selected_id, $event_id, $name, $plate, $owner, $food, $description;

    public function render()
    {
        $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.foodtrucks.view', [
            'foodtrucks' => Foodtruck::latest()
                        ->orWhere('name', 'LIKE', $keyWord)
                        ->orWhere('plate', 'LIKE', $keyWord)
                        ->orWhere('owner', 'LIKE', $keyWord)
                        ->orWhere('food', 'LIKE', $keyWord)
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
        $this->event_id = null;
        $this->name = null;
        $this->plate = null;
        $this->owner = null;
        $this->food = null;
        $this->description = null;
    }

    public function store()
    {
        $this->validate(Foodtruck::$rules, Foodtruck::$message);

        Foodtruck::create([ 
            'event_id' => $this-> event_id,
            'name' => $this-> name,
            'plate' => $this-> plate,
            'owner' => $this-> owner,
            'food' => $this-> food,
            'description' => $this-> description
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('message', 'Foodtruck Successfully created.');
    }

    public function edit($id)
    {
        $record = Foodtruck::findOrFail($id);
        $this->selected_id = $id; 
        $this->event_id = $record-> event_id;
        $this->name = $record-> name;
        $this->plate = $record-> plate;
        $this->owner = $record-> owner;
        $this->food = $record-> food;
        $this->description = $record-> description;
    }

    public function update()
    {
        $this->validate(Foodtruck::$rules, Foodtruck::$message);

        if ($this->selected_id) {
            $record = Foodtruck::find($this->selected_id);
            $record->update([ 
            'event_id' => $this-> event_id,
            'name' => $this-> name,
            'plate' => $this-> plate,
            'owner' => $this-> owner,
            'food' => $this-> food,
            'description' => $this-> description
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
            session()->flash('message', 'Foodtruck Successfully updated.');
        }
    }

    public function approve($id)
    {
        $record = Foodtruck::find($id);
        $accepted = $record->replicate();
        $accepted->setTable('foodtrucks_accepted');
        $accepted->save();
        $record->delete();
    }

    public function destroy($id)
    {
        if ($id) {
            Foodtruck::where('id', $id)->delete();
        }
    }
}
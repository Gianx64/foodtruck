<?php

namespace App\Http\Livewire;

use App\Models\Foodtruck;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

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
                        ->paginate(10),
            'events' => DB::table('events')->select('name', 'slots')->get()->toArray()
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
        session()->flash('message', 'Foodtruck successfully created.');
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
            session()->flash('message', 'Foodtruck successfully updated.');
        }
    }

    public function approve($id)
    {
        if (DB::table('foodtrucks_accepted')->where('event_id', $this->event_id)->count() < DB::table('events')->where('id', $this->event_id)->first()->slots)
            if (DB::table('foodtrucks_accepted')->where('event_id', $this->event_id)->where('food', $this->food)->first() === null)
            {
                $record = Foodtruck::find($id);
                $accepted = $record->replicate();
                $accepted->setTable('foodtrucks_accepted');
                $accepted->save();
                $record->delete();

                session()->flash('message', 'Foodtruck successfully approved.');
            }
            else
                session()->flash('message', "There's already a foodtruck with this food in this event.");
        else
            session()->flash('message', "There's no room for this foodtruck in this event.");
        $this->dispatchBrowserEvent('closeModal');
    }

    public function destroy($id)
    {
        if ($id) {
            Foodtruck::where('id', $id)->delete();
            session()->flash('message', 'Foodtruck successfully deleted.');
        }
    }
}
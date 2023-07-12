<?php

namespace App\Http\Livewire;

use App\Models\Foodtruck as FoodtruckModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Foodtruck extends Component
{
    use WithFileUploads;

    public $foodtypes, $foodtruckname, $plate, $food, $description;
    //public $documents = [];

    public function render()
    {
        return view('livewire.foodtrucks.modals');
    }

    public function mount()
    {
        $this->foodtypes = DB::table('foodtypes')->pluck('name')->toArray();
    }

    public function store()
    {
        $this->validate(FoodtruckModel::$rules, FoodtruckModel::$message);
        /*$this->validate(['documents.*' => 'required|mimes:pdf']);
 
        foreach ($this->documents as $document) {
            $document->storePublicly('public/documents');
        }*/

        FoodtruckModel::create([
            'user_id' => auth()->user()->id,
            'name' => $this-> name,
            'plate' => $this-> plate,
            'owner' => auth()->user()->email,
            'food' => $this-> food,
            'description' => $this-> description
        ]);

        return redirect()->route('events.show', $this->event_id)
            ->with('success', 'Foodtruck applied successfully.');
    }

    public function edit($id)
    {
        $record = FoodtruckModel::findOrFail($id);
        $this->foodtruckname = $record-> foodtruck_name;
        $this->plate = $record-> plate;
        $this->food = $record-> food;
        $this->description = $record-> description;
    }

    public function update()
    {
        $this->validate(FoodtruckModel::$rules, FoodtruckModel::$message);

        if ($this->selected_id) {
            $record = FoodtruckModel::find($this->selected_id);
            $record->update([ 
            'name' => $this-> foodtruckname,
            'plate' => $this-> plate,
            'food' => $this-> food,
            'description' => $this-> description
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
            session()->flash('message', 'Foodtruck successfully updated.');
        }
    }
}
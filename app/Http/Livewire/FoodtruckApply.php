<?php

namespace App\Http\Livewire;

use App\Models\Foodtruck;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class FoodtruckApply extends Component
{
    use WithFileUploads;

    public $foodtypes, $event_id, $foodtruck_id, $foodtruck_name, $plate, $food, $description;

    public function render()
    {
        return view('livewire.foodtrucks.apply');
    }

    public function mount($id)
    {
        $this->event_id = $id;
        $this->foodtypes = DB::table('foodtypes')->pluck('name')->toArray();
        $record = DB::table('foodtrucks')->where('user_id', auth()->user()->id)->first();
        if ($record !== null)
        {
            $this->foodtruck_id = $record-> id;
            $this->plate = $record-> plate;
            $this->foodtruck_name = $record-> foodtruck_name;
            $this->food = $record-> food;
            $this->description = $record-> description;
        }
        else
        {
            $this->foodtruck_id = null;
            $this->plate = null;
            $this->foodtruck_name = 'null';
            $this->food = null;
            $this->description = null;
        }
    }

    public function cancel()
    {
        $this->dispatchBrowserEvent('closeModal');
    }

    public function apply()
    {
        $this->validate([
            'food' => 'required|unique:foodtrucks_applications,food,NULL,id,event_id,'.$this-> event_id
        ], [
            'food.required' => 'The food type is required.',
            'food_id.unique' => 'This food type is already taken.'
        ]);

        Foodtruck::create([
            'event_id' => $this-> event_id,
            'foodtruck_id' => $this-> foodtruck_id,
            'food' => $this-> food
        ]);

        redirect()->route('events.show', $this->event_id);
		session()->flash('message', 'Foodtruck application successful.');
    }
}
<?php

namespace App\Http\Livewire;

use App\Models\Application;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FoodtruckApply extends Component {
    public $foodtypes, $event_id, $foodtruck_id, $foodtruck_name, $plate, $food, $description;

    public function render() {
        return view('livewire.foodtrucks.apply', [
            'foodtrucks' => DB::table('foodtrucks')
            ->where('user_id', auth()->user()->id)
            ->latest()
            ->paginate(10)
        ]);
    }

    public function mount($id) {
        $this->event_id = $id;
        $this->foodtypes = DB::table('foodtypes')->pluck('name')->toArray();
    }

    public function cancel() {
        $this->dispatchBrowserEvent('closeModal');
    }

    public function preview($id) {
        $this->foodtruck_id = $id;
        $record = DB::table('foodtrucks')->where('user_id', auth()->user()->id)->where('id', $id)->first();
        $this->food = $record-> food;
        $this->plate = $record-> plate;
        $this->foodtruck_name = $record-> foodtruck_name;
        $this->description = $record-> description;
    }

    public function apply() {
        $this->validate([
            'foodtruck_id' => 'required|unique:foodtrucks_applications,foodtruck_id,NULL,id,event_id,'.$this-> event_id,
            'food' => 'required|unique:foodtrucks_applications,food,NULL,id,event_id,'.$this-> event_id
        ], Application::$message);

        Application::create([
            'event_id' => $this-> event_id,
            'foodtruck_id' => $this-> foodtruck_id,
            'food' => $this-> food
        ]);

        redirect()->route('events.show', $this->event_id);
        session()->flash('message', 'Foodtruck application successful.');
    }
}
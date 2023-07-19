<?php

namespace App\Http\Livewire;

use App\Models\Application;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FoodtruckApply extends Component {
    protected $paginationTheme = 'bootstrap';
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

    public function edit($id) {
        $this->foodtruck_id = $id;
        $record = DB::table('foodtrucks')->where('user_id', auth()->user()->id)->where('id', $id)->first();
        $this->food = $record-> food;
        $this->plate = $record-> plate;
        $this->foodtruck_name = $record-> foodtruck_name;
        $this->description = $record-> description;
    }

    public function store() {
        $this->validate([
            'event_id' => 'required|integer',
            'foodtruck_id' => 'required|integer|unique:foodtrucks_applications,foodtruck_id,NULL,id,event_id,'.$this-> event_id,
            'food' => [
                'required', 'exists:foodtypes,name',
                Rule::unique('foodtrucks_applications')->where('event_id', $this-> event_id)->where('approved', 1)
            ]
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
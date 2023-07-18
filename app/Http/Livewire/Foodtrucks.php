<?php

namespace App\Http\Livewire;

use App\Models\Foodtruck;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Foodtrucks extends Component {
    use WithFileUploads;

    public $selected_id, $foodtypes, $plate, $plate_old, $foodtruck_name, $food, $description;

    public function render() {
        return view('livewire.foodtrucks.view', [
            'foodtrucks' => Foodtruck::where('user_id', auth()->user()->id)->latest()->paginate(10)
        ]);
    }

    public function mount() {
        $this->foodtypes = DB::table('foodtypes')->pluck('name')->toArray();
        $this->food = $this->foodtypes[0];
    }

    public function cancel() {
        $this->resetInput();
    }

    public function resetInput() {
        $this->plate = null;
        $this->plate_old = null;
        $this->foodtruck_name = null;
        $this->food = null;
        $this->description = null;
    }

    public function store() {
        $this->validate(Foodtruck::$rules, Foodtruck::$message);

        Foodtruck::create([
            'user_id' => auth()->user()->id,
            'plate' => $this-> plate,
            'foodtruck_name' => $this-> foodtruck_name,
            'food' => $this-> food,
            'description' => $this-> description,
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString()
        ]);

        $this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Foodtruck successfully created.');
    }

    public function edit($id) {
        $this->selected_id = $id;
        $record = Foodtruck::where('user_id', auth()->user()->id)->where('id', $id)->first();
        $this->food = $record-> food;
        $this->plate = $record-> plate;
        $this->plate_old = $record-> plate;
        $this->foodtruck_name = $record-> foodtruck_name;
        $this->description = $record-> description;
    }

    public function update() {
        if ($this->plate == $this->plate_old)
            $this->validate(array_slice(Foodtruck::$rules, 1), Foodtruck::$message);
        else
            $this->validate(Foodtruck::$rules, Foodtruck::$message);

        Foodtruck::where('user_id', auth()->user()->id)->where('id', $this->selected_id)->update([
            'plate' => $this-> plate,
            'foodtruck_name' => $this-> foodtruck_name,
            'food' => $this-> food,
            'description' => $this-> description,
            'updated_at' => now()->toDateTimeString()
        ]);

        $this->dispatchBrowserEvent('closeModal');
        session()->flash('message', 'Foodtruck successfully updated.');
    }

    public function destroy($id) {
        if ($id) {
            Foodtruck::where('id', $id)->delete();
            session()->flash('message', 'Foodtruck successfully deleted.');
        }
    }
}
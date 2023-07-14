<?php

namespace App\Http\Livewire;

use App\Models\Foodtruck as FoodtruckModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Foodtruck extends Component
{
    use WithFileUploads;

    public $hasFoodtruck, $foodtypes, $plate, $plate_old, $foodtruck_name, $food, $description;
    //public $documents = [];

    public function render()
    {
        return view('livewire.foodtrucks.manage');
    }

    public function mount()
    {
        $this->hasFoodtruck = DB::table('foodtrucks')->where('user_id', auth()->user()->id)->exists();
        $this->foodtypes = DB::table('foodtypes')->pluck('name')->toArray();
        $this->food = $this->foodtypes[0];
        $this->resetInput();
    }

    public function cancel()
    {
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInput();
    }

    public function resetInput()
    {
        $record = DB::table('foodtrucks')->where('user_id', auth()->user()->id)->first();
        if ($record !== null)
        {
            $this->plate = $record-> plate;
            $this->plate_old = $record-> plate;
            $this->foodtruck_name = $record-> foodtruck_name;
            $this->food = $record-> food;
            $this->description = $record-> description;
        }
        else
        {
            $this->plate = null;
            $this->plate_old = null;
            $this->foodtruck_name = null;
            $this->food = null;
            $this->description = null;
        }
    }

    public function store()
    {
        $this->validate(FoodtruckModel::$rules, FoodtruckModel::$message);
        /*$this->validate(['documents.*' => 'required|mimes:pdf']);
 
        foreach ($this->documents as $document) {
            $document->storePublicly('public/documents');
        }*/

        DB::table('foodtrucks')->insertGetId([
            'user_id' => auth()->user()->id,
            'plate' => $this-> plate,
            'foodtruck_name' => $this-> foodtruck_name,
            'food' => $this-> food,
            'description' => $this-> description,
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString()
        ]);

        redirect()->route('users.edit');
		session()->flash('message', 'Foodtruck successfully created.');
    }

    public function update()
    {
        if ($this->plate == $this->plate_old)
            $this->validate(array_slice(FoodtruckModel::$rules, 1), FoodtruckModel::$message);
        else
            $this->validate(FoodtruckModel::$rules, FoodtruckModel::$message);

        DB::table('foodtrucks')->where('user_id', auth()->user()->id)->update([
            'plate' => $this-> plate,
            'foodtruck_name' => $this-> foodtruck_name,
            'food' => $this-> food,
            'description' => $this-> description,
            'updated_at' => now()->toDateTimeString()
        ]);

        redirect()->route('users.edit');
        session()->flash('message', 'Foodtruck successfully updated.');
    }
}
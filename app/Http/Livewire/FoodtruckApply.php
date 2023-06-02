<?php

namespace App\Http\Livewire;

use App\Models\Foodtruck;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class FoodtruckApply extends Component
{
    use WithFileUploads;

    public $event_id, $event_name, $name, $plate, $owner, $foodtypes, $food, $description, $documents = [];

    public function render()
    {
        return view('livewire.foodtrucks.apply');
    }

    public function mount($id)
    {
        $this->event_id = $id;
        $this->event_name = DB::table('events')->where('id', '=', $id)->first()->name;
        $this->foodtypes = DB::table('foodtypes')->pluck('name')->toArray();
        $accepted_fts = DB::table('foodtrucks_accepted')->where('event_id', $id)->get();
        if(!($accepted_fts->isEmpty()))
            foreach($accepted_fts as $accepted_ft)
                array_splice($this->foodtypes, array_search($accepted_ft->food, $this->foodtypes), 1);
    }

    public function store()
    {
        $this->validate(Foodtruck::$rules, Foodtruck::$message);
        $this->validate(['documents.*' => 'required|mimes:pdf']);
 
        foreach ($this->documents as $document) {
            $document->storePublicly('public/documents');
        }

        Foodtruck::create([
            'event_id' => $this-> event_id,
            'name' => $this-> name,
            'plate' => $this-> plate,
            'owner' => $this-> owner,
            'food' => $this-> food,
            'description' => $this-> description
        ]);

        return redirect()->route('events.show', $this->event_id)
            ->with('success', 'Foodtruck applied successfully.');
    }
}
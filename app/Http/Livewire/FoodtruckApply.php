<?php

namespace App\Http\Livewire;

use App\Models\Application;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FoodtruckApply extends Component {
    protected $paginationTheme = 'bootstrap';
    public $foodtypes, $documents = [], $approved = [], $event_id, $foodtruck_id, $foodtruck_name, $plate, $foods = [], $description;
    public $food; //From Livewire/Foodtruck.php to avoid modal errors

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
        $this->documents = explode(', ', DB::table('events')->where('id', $id)->first()->documents);
        $this->foodtypes = DB::table('foodtypes')->pluck('name')->toArray();
    }

    public function cancel() {
        $this->dispatchBrowserEvent('closeModal');
    }

    public function edit($id) {
        $this->foodtruck_id = $id;
        $record = DB::table('foodtrucks')->where('user_id', auth()->user()->id)->where('id', $id)->first();
        $this->foods = explode(',',$record-> food);
        $this->food = $record-> food;
        $this->plate = $record-> plate;
        $this->foodtruck_name = $record-> foodtruck_name;
        $this->description = $record-> description;
        $this->approved = DB::table('foodtrucks_documents_applications')
        ->where('foodtruck_id', $id)->where('approved', 1)->where('expires', '>=', date("Y-m-d"))
        ->pluck('document_name')->toArray();
    }

    public function store() {
        //hardcoded
        $this->validate([
            'event_id' => 'required|integer',
            'foodtruck_id' => 'required|integer|unique:foodtrucks_applications,foodtruck_id,NULL,id,event_id,'.$this-> event_id,
            'foods' => 'required|array|min:1|max:3',
            /*'foods.*' => [
                'required', 'exists:foodtypes,name',
                Rule::unique('foodtrucks_applications')->where('event_id', $this-> event_id)->where('approved', 1)
            ]*/
        ], Application::$message);

        $count = 0;
        foreach($this->documents as $document)
            foreach($this->approved as $approved)
                if($document == $approved)
                    $count++;
        if(count($this->documents) == $count){
            Application::create([
                'event_id' => $this-> event_id,
                'foodtruck_id' => $this-> foodtruck_id,
                'food' => $this-> food
            ]);
            redirect()->route('events.show', $this->event_id);
            session()->flash('message', 'Foodtruck application successful.');
        }
        else
            $this->validate(['approved' => 'integer'], ['approved.integer' => 'This foodtruck is missing documents for this event.']);
    }
}
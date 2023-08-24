<?php

namespace App\Http\Livewire;

use App\Mail\ApplicationApproved;
use App\Models\Application;
use App\Models\Foodtruck;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class Applications extends Component {
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $keyWord, $selected_id, $event_id, $event_name, $foodtruck_id, $foodtruck_name, $plate, $owner, $foods = [], $documents = [], $approved = [], $links = [], $description;

    public function render() {
        $keyWord = '%'.$this->keyWord.'%';
        return view('livewire.applications.view', [
            'foodtrucks' => Application::leftJoin('events', 'foodtrucks_applications.event_id', 'events.id')
                        ->leftJoin('foodtrucks', 'foodtrucks_applications.foodtruck_id', 'foodtrucks.id')
                        ->leftJoin('users', 'foodtrucks.user_id', 'users.id')
                        ->select('foodtrucks_applications.*', 'events.name', 'foodtrucks.plate', 'foodtrucks.foodtruck_name', 'foodtrucks.description', 'users.email')
                        ->orWhere('plate', 'LIKE', $keyWord)
                        ->where('approved', 0)
                        ->orWhere('email', 'LIKE', $keyWord)
                        ->where('approved', 0)
                        ->orWhere('foodtruck_name', 'LIKE', $keyWord)
                        ->where('approved', 0)
                        ->orWhere('foodtrucks_applications.food', 'LIKE', $keyWord)
                        ->where('approved', 0)
                        ->paginate(10)
        ]);
    }

    public function cancel() {
        $this->resetInput();
    }

    private function resetInput() {
        $this->event_id = null;
        $this->plate = null;
        $this->owner = null;
        $this->foodtruck_name = null;
        $this->foods = [];
        $this->documents = [];
        $this->approved = [];
        $this->description = null;
    }

    public function edit($row) {
        $this->selected_id = $row['id'];
        $record = Application::findOrFail($row['id']);
        $this->event_id = $record-> event_id;
        $this->event_name = $row['name'];
        $this->foodtruck_id = $record-> foodtruck_id;
        $this->foods = explode(', ',$record-> food);
        $this->documents = explode(', ', DB::table('events')->where('id', $record-> event_id)->first()->documents);
        $this->approved = DB::table('foodtrucks_documents_applications')
        ->where('foodtruck_id', $record-> foodtruck_id)->where('approved', 1)
        ->where('expires', '>=', date("Y-m-d"))->get();
        $foodtruck = DB::table('foodtrucks')->where('id', $this->foodtruck_id)->first();
        $this->plate = $foodtruck-> plate;
        $this->foodtruck_name = $foodtruck-> foodtruck_name;
        $this->description = $foodtruck-> description;
        $user = DB::table('users')->where('id', $foodtruck-> user_id)->first();
        $this->owner = $user-> email;
    }
//TODO: cambiar mensajes de error
    public function update() {
        if (DB::table('foodtrucks_applications')->where('event_id', $this->event_id)->where('approved', 1)
            ->count() < DB::table('events')->where('id', $this->event_id)->first()->slots) {
            if (DB::table('foodtrucks_applications')->where('event_id', $this->event_id)
                ->where('approved', 1)->where('food', implode(', ',$this->foods))->first() === null) {
                $record = Application::findOrFail($this-> selected_id);
                $record->update(['approved' => 1]);

                Mail::to(User::findOrFail(Foodtruck::where('id', $this->foodtruck_id)->first()->user_id)->email)->send(new ApplicationApproved);

                //$this->dispatchBrowserEvent('closeModal');
                //$this->resetInput();
                session()->flash('message', 'Foodtruck successfully approved.');
            }
            else
                session()->flash('message', "There's already a foodtruck with this food in this event.");
                //$this->validate(['foods' => 'integer'], ['foods.integer' => "There's already a foodtruck with this food in this event."]);
        }
        else
            session()->flash('message', "There's no room for more foodtrucks in this event.");
            //$this->validate(['event_id' => 'string'], ['event_id.string' => "There's no room for more foodtrucks in this event."]);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInput();
    }

    public function destroy($id) {
        if ($id) {
            Application::where('id', $id)->delete();
            session()->flash('message', 'Application successfully deleted.');
        }
    }
}
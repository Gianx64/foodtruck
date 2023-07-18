<?php

namespace App\Http\Livewire;

use App\Models\Application;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Applications extends Component {
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $keyWord, $selected_id, $event_id, $foodtruck_id, $foodtruck_name, $plate, $owner, $food, $description;

    public function render() {
        $keyWord = '%'.$this->keyWord.'%';
        return view('livewire.applications.view', [
            'foodtrucks' => Application::leftJoin('foodtrucks', 'foodtrucks_applications.foodtruck_id', 'foodtrucks.id')
                        ->leftJoin('users', 'foodtrucks.user_id', 'users.id')
                        ->select('foodtrucks_applications.*', 'foodtrucks.plate', 'foodtrucks.foodtruck_name', 'foodtrucks.description', 'users.email')
                        ->orWhere('plate', 'LIKE', $keyWord)
                        ->where('approved', 0)
                        ->orWhere('email', 'LIKE', $keyWord)
                        ->where('approved', 0)
                        ->orWhere('foodtruck_name', 'LIKE', $keyWord)
                        ->where('approved', 0)
                        ->orWhere('foodtrucks_applications.food', 'LIKE', $keyWord)
                        ->where('approved', 0)
                        ->paginate(10),
            'events' => DB::table('events')->select('name', 'slots')->get()->toArray()
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
        $this->food = null;
        $this->description = null;
    }

    public function edit($id) {
        $this->selected_id = $id;
        $record = Application::findOrFail($id);
        $this->event_id = $record-> event_id;
        $this->foodtruck_id = $record-> foodtruck_id;
        $this->food = $record-> food;
        $foodtruck = DB::table('foodtrucks')->where('id', $this->foodtruck_id)->first();
        $this->plate = $foodtruck-> plate;
        $this->foodtruck_name = $foodtruck-> foodtruck_name;
        $this->description = $foodtruck-> description;
        $user = DB::table('users')->where('id', $foodtruck-> user_id)->first();
        $this->owner = $user-> email;
    }

    public function approve() {
        if (DB::table('foodtrucks_applications')->where('event_id', $this->event_id)->where('approved', 1)->count()
            < DB::table('events')->where('id', $this->event_id)->first()->slots)
            if (DB::table('foodtrucks_applications')->where('event_id', $this->event_id)->where('approved', 1)->where('food', $this->food)->first() === null)
            {
                $record = Application::find($this-> selected_id);
                $record->update([
                    'event_id' => $this->event_id,
                    'foodtruck_id' => $this->foodtruck_id,
                    'food', $this->food,
                    'approved' => 1
                ]);

                session()->flash('message', 'Foodtruck successfully approved.');
            }
            else
                session()->flash('message', "There's already a foodtruck with this food in this event.");
        else
            session()->flash('message', "There's no room for this foodtruck in this event.");
        $this->dispatchBrowserEvent('closeModal');
    }

    public function destroy($id) {
        if ($id) {
            Application::where('id', $id)->delete();
            session()->flash('message', 'Application successfully deleted.');
        }
    }
}
<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class FoodTypes extends Component {
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $keyWord, $name;

    public function render() {
        $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.food-types', [
            'foodtypes' => DB::table('foodtypes')->latest()
                        ->orWhere('name', 'LIKE', $keyWord)
                        ->paginate(10) ]);
    }

    private function resetInput() {
        $this->name = null;
    }

    public function store() {
        if(str_contains($this->name, ', '))
            $this->validate(['name' => 'integer'], ['name.integer' => 'Name cannot contain ", " (comma)(space)']);
        //DB::table('foodtypes')->insert(['name' => ucwords(strtolower($this-> name))]);
        DB::table('foodtypes')->insert(['name' => $this-> name]);
        
        $this->resetInput();
        session()->flash('message', 'Food type successfully created.');
    }

    public function destroy($id) {
        if ($id) {
            DB::table('foodtypes')->where('id', $id)->delete();
            session()->flash('message', 'Food type successfully deleted.');
        }
    }
}
<?php

namespace App\Http\Livewire;

use App\Models\Foodtype;
use Livewire\Component;
use Livewire\WithPagination;

class Foodtypes extends Component {
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $keyWord, $name;

    public function render() {
        $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.foodtypes', [
            'foodtypes' => Foodtype::latest()
                        ->orWhere('name', 'LIKE', $keyWord)
                        ->paginate(10) ]);
    }

    private function resetInput() {
        $this->name = null;
    }

    public function store() {
        Foodtype::create([ 'name' => $this-> name ]);
        
        $this->resetInput();
        session()->flash('message', 'Foodtype successfully created.');
    }

    public function destroy($id) {
        if ($id) {
            Foodtype::where('id', $id)->delete();
            session()->flash('message', 'Foodtype successfully deleted.');
        }
    }
}
<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DocumentNames extends Component {
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $keyWord, $name;

    public function render() {
        $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.document-names', [
            'documentnames' => DB::table('documentnames')->latest()
                        ->orWhere('name', 'LIKE', $keyWord)
                        ->paginate(10) ]);
    }

    private function resetInput() {
        $this->name = null;
    }

    public function store() {
        if(str_contains($this->name, ', '))
            $this->validate(['name' => 'integer'], ['name.integer' => 'Name cannot contain ", " (comma)(space)']);
        //DB::table('documentnames')->insert(['name' => ucwords(strtolower($this-> name))]);
        DB::table('documentnames')->insert(['name' => $this-> name]);
        
        $this->resetInput();
        session()->flash('message', 'Document name successfully created.');
    }

    public function destroy($id) {
        if ($id) {
            DB::table('documentnames')->where('id', $id)->delete();
            session()->flash('message', 'Document name successfully deleted.');
        }
    }
}
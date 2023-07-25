<?php

namespace App\Http\Livewire;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Documents extends Component {
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $foodtruck_id, $plate, $foodtruck_name, $document_name, $expires, $file;

    public function render() {
        $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.documents.view', [
            'documents' => Document::leftJoin('foodtrucks', 'foodtrucks_documents_applications.foodtruck_id', 'foodtrucks.id')
                        ->select('foodtrucks_documents_applications.*', 'foodtrucks.plate', 'foodtrucks.foodtruck_name')
                        ->orWhere('plate', 'LIKE', $keyWord)
                        ->where('approved', 0)
                        ->orWhere('foodtruck_name', 'LIKE', $keyWord)
                        ->where('approved', 0)
                        ->orWhere('document_name', 'LIKE', $keyWord)
                        ->where('approved', 0)
                        ->orWhere('expires', 'LIKE', $keyWord)
                        ->where('approved', 0)
                        ->orWhere('file', 'LIKE', $keyWord)
                        ->where('approved', 0)
                        ->paginate(10),
        ]);
    }

    public function cancel() {
        $this->resetInput();
    }

    private function resetInput() {
        $this->foodtruck_id = null;
        $this->plate = null;
        $this->foodtruck_name = null;
        $this->document_name = null;
        $this->expires = null;
        $this->file = null;
    }

    public function edit($row) {
        $record = Document::findOrFail($row['id']);
        $this->selected_id = $row['id']; 
        $this->foodtruck_id = $record-> foodtruck_id;
        $this->plate = $row['plate'];
        $this->foodtruck_name = $row['foodtruck_name'];
        $this->document_name = $record-> document_name;
        $this->expires = $record-> expires;
        $this->file = $record-> file;
        $this->file = Storage::url($this->file);
    }

    public function update() {
        $this->validate(Document::$rules, Document::$message);

        if ($this->selected_id) {
            $record = Document::find($this->selected_id);
            $record->update(['accepted' => 1]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
            session()->flash('message', 'Document successfully approved.');
        }
    }

    public function destroy($id) {
        $record = Document::findOrFail($id);
        if(file_exists(storage_path('app').'/'.$record->file))
            if(unlink(storage_path('app').'/'.$record->file)){
                $record->delete();
                session()->flash('message', 'Document successfully deleted.');
            }
    }
}
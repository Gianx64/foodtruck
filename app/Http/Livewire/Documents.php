<?php

namespace App\Http\Livewire;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithPagination;

class Documents extends Component {
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $foodtruck_id, $document_name, $file, $expires, $accepted;

    public function render() {
        $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.documents.view', [
            'documents' => Document::orWhere('foodtruck_id', 'LIKE', $keyWord)
                        ->where('approved', 0)
                        ->orWhere('document_name', 'LIKE', $keyWord)
                        ->where('approved', 0)
                        ->orWhere('file', 'LIKE', $keyWord)
                        ->where('approved', 0)
                        ->orWhere('expires', 'LIKE', $keyWord)
                        ->where('approved', 0)
                        ->paginate(10),
        ]);
    }

    public function cancel() {
        $this->resetInput();
    }

    private function resetInput() {
        $this->foodtruck_id = null;
        $this->document_name = null;
        $this->file = null;
        $this->expires = null;
        $this->accepted = null;
    }

    public function edit($id) {
        $record = Document::findOrFail($id);
        $this->selected_id = $id; 
        $this->foodtruck_id = $record-> foodtruck_id;
        $this->document_name = $record-> document_name;
        $this->file = $record-> file;
        $this->expires = $record-> expires;
        $this->accepted = $record-> accepted;
    }

    public function update() {
        $this->validate([
        'foodtruck_id' => 'required',
        'document_name' => 'required',
        'file' => 'required',
        'expires' => 'required',
        'accepted' => 'required',
        ]);

        if ($this->selected_id) {
            $record = Document::find($this->selected_id);
            $record->update([ 
            'foodtruck_id' => $this-> foodtruck_id,
            'document_name' => $this-> document_name,
            'file' => $this-> file,
            'expires' => $this-> expires,
            'accepted' => $this-> accepted
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
            session()->flash('message', 'Document Successfully updated.');
        }
    }

    public function destroy($id) {
        if ($id) {
            Document::where('id', $id)->delete();
        }
    }
}
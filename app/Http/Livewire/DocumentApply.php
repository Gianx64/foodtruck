<?php

namespace App\Http\Livewire;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithFileUploads;

class DocumentApply extends Component {
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $plate, $foodtruck_name, $document_name, $expires, $file;

    public function render() {
        return view('livewire.documents.apply');
    }

    public function mount($row) {
        $this->selected_id = $row['id'];
        $this->plate = $row['plate'];
        $this->foodtruck_name = $row['foodtruck_name'];
    }

    public function cancel() {
        $this->resetInput();
    }

    private function resetInput() {
        $this->selected_id = null;
        $this->plate = null;
        $this->foodtruck_name = null;
        $this->document_name = null;
        $this->expires = null;
    }

    public function store() {
        $this->validate(Document::$rules, Document::$message);
        $document = $this->file->storePublicly('public/documents');

        Document::create([
            'selected_id' => $this-> selected_id,
            'document_name' => $this-> document_name,
            'expires' => $this-> expires,
            'file' => $document
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('message', 'Document successfully created.');
    }
}
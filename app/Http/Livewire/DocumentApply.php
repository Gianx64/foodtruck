<?php

namespace App\Http\Livewire;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithFileUploads;

class DocumentApply extends Component {
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $foodtruck_id, $document_name, $expires, $document;

    public function render() {
        return view('livewire.documents.apply');
    }

    public function mount($id) {
        $this->foodtruck_id = $id;
    }

    public function cancel() {
        $this->resetInput();
    }

    private function resetInput() {
        $this->foodtruck_id = null;
        $this->document_name = null;
        $this->expires = null;
    }

    public function store() {
        $this->validate(Document::$rules, Document::$message);
        $file = $this->document->storePublicly('public/documents');

        Document::create([ 
            'foodtruck_id' => $this-> foodtruck_id,
            'document_name' => $this-> document_name,
            'expires' => $this-> expires,
            'file' => $file
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('message', 'Document Successfully created.');
    }
}
<?php

namespace App\Http\Livewire;

use App\Models\Document;
use App\Models\Foodtruck;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class DocumentApply extends Component {
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $foodtruck_list, $document_list, $foodtruck_id, $plate, $foodtruck_name, $document_name, $expires, $file;
    public $selected_id; //From Livewire/Documents.php to avoid modal errors

    public function render() {
        return view('livewire.documents.apply');
    }

    public function mount() {
        $this->foodtruck_list = Foodtruck::where('user_id', auth()->user()->id)
        ->select('id', 'plate', 'foodtruck_name')->get();
        $this->plate = $this->foodtruck_list[0]['plate'];
        $this->foodtruck_id = $this->foodtruck_list->firstWhere('plate', $this->plate)['id'];
        $this->foodtruck_name = $this->foodtruck_list->firstWhere('plate', $this->plate)['foodtruck_name'];
        $this->document_list = DB::table('documentnames')->pluck('name');
        $this->document_name = $this->document_list[0];
    }

    public function updatedPlate() {
        $this->foodtruck_id = $this->foodtruck_list->firstWhere('plate', $this->plate)['id'];
        $this->foodtruck_name = $this->foodtruck_list->firstWhere('plate', $this->plate)['foodtruck_name'];
    }

    public function cancel() {
        $this->resetInput();
    }

    private function resetInput() {
        $this->expires = null;
        $this->file = null;
    }

    public function store() {
        $this->validate(Document::$rules, Document::$message);
        $document = $this->file->storePublicly('public/documents');

        Document::create([
            'foodtruck_id' => $this-> foodtruck_id,
            'document_name' => $this-> document_name,
            'expires' => $this-> expires,
            'file' => $document
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('message', 'Document successfully created for review.');
    }
}
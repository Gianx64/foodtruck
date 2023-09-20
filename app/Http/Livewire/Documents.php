<?php

namespace App\Http\Livewire;

use App\Mail\DocumentApproved;
use App\Models\Document;
use App\Models\Foodtruck;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class Documents extends Component {
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $foodtruck_id, $plate, $foodtruck_name, $document_name, $expires, $file;
    public $foodtruck_list, $document_list; //From Livewire/DocumentApply.php to avoid modal errors

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
    }

    public function update() {
        if(strval(Document::where('foodtruck_id', $this->foodtruck_id)->where('approved', 1)
        ->where('expires', '>=', date("Y-m-d"))->get()) == '[]') {
            $this->validate([
                'document_name' => 'required|string|exists:documentnames,name',
                'foodtruck_id' => 'required|integer',
                'expires' => 'required|date'
            ], Document::$message);
    
            $record = Document::findOrFail($this->selected_id);
            $record->update(['approved' => 1]);

            Mail::to(User::findOrFail(Foodtruck::where('id', $this->foodtruck_id)->first()->user_id)->email)->send(new DocumentApproved($this->plate, $this->foodtruck_name, $this->document_name));
    
            $this->dispatchBrowserEvent('closeModal');
            $this->resetInput();
            session()->flash('message', 'Document successfully approved.');
        }
        else
            $this->validate(['expires' => 'integer'], ['expires.integer' => 'This foodtruck already has a current document.']);
    }

    public function destroy($id) {
        $record = Document::findOrFail($id);
        if(file_exists(storage_path('app').'/'.$record->file))
            if(unlink(storage_path('app').'/'.$record->file)) {
                $record->delete();
                session()->flash('message', 'Document successfully deleted.');
            }
    }
}
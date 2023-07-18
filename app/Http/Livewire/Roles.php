<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Roles extends Component {
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $keyWord, $selected_id, $name, $permissions, $permissions_selected = [];

    public function render() {
        $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.roles.view', [
            'roles' => Role::latest()
                        ->orWhere('name', 'LIKE', $keyWord)
                        //->orWhere('guard_name', 'LIKE', $keyWord)
                        ->paginate(10),
        ]);
    }

    public function mount() {
        $this->permissions = Permission::all();
    }

    public function cancel() {
        $this->resetInput();
    }

    private function resetInput() {       
        $this->name = null;
        $this->permissions_selected = [];
    }

    public function store() {
        $this->validate([ 'name' => 'required' ]);

        $record = Role::create([ 'name' => $this-> name ]);
        $record->permissions()->sync($this->permissions_selected);
        
        $this->resetInput();
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('message', 'Role successfully created.');
    }

    public function edit($id) {
        $record = Role::findOrFail($id);
        $this->selected_id = $id; 
        $this->name = $record-> name;
        foreach ($record->permissions as $permission)
            array_push($this->permissions_selected, $permission->id);
    }

    public function checkPermission($id) {
        if(in_array($id, $this->permissions_selected))
            array_splice($this->permissions_selected, array_search($id, $this->permissions_selected), 1);
        else
            array_push($this->permissions_selected, $id);
    }

    public function update() {
        $this->validate([ 'name' => 'required' ]);

        if ($this->selected_id) {
            $record = Role::find($this->selected_id);
            $record->update([ 'name' => $this-> name ]);
            $record->permissions()->sync($this->permissions_selected);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
            session()->flash('message', 'Role successfully updated.');
        }
    }

    public function destroy($id) {
        if ($id) {
            Role::where('id', $id)->delete();
            session()->flash('message', 'Role successfully deleted.');
        }
    }
}
<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $email, $email_old, $password, $password_confirmation, $roles, $roles_selected = [];

    public function render()
    {
        $this->roles = Role::all();
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.users.view', [
            'users' => User::latest()
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->name = null;
		$this->email = null;
		$this->email_old = null;
		$this->password = null;
		$this->password_confirmation = null;
		$this->roles = null;
		$this->roles_selected = [];
    }

    public function store()
    {
        $this->validate(User::$rules, User::$message);

        User::create([ 
			'name' => $this-> name,
			'email' => $this-> email,
			'password' => Hash::make($this-> password)
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'User Successfully created.');
    }

    public function edit($id)
    {
        $record = User::findOrFail($id);
        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->email = $record-> email;
		$this->email_old = $record-> email;
    }

    public function assign($id)
    {
        $record = User::findOrFail($id);
        $this->roles = Role::all();
        $this->selected_id = $id;
        foreach ($record->roles as $role)
            array_push($this->roles_selected, $role->id);
    }

    public function update()
    {
        if ($this->email == $this->email_old)
            $this->validate(array_slice(User::$rules, 1), User::$message);
        else
            $this->validate(User::$rules, User::$message);

        if ($this->selected_id) {
			$record = User::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'email' => $this-> email,
			'password' => Hash::make($this-> password)
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'User Successfully updated.');
        }
    }

    public function checkRole($id)
    {
        if(in_array($id, $this->roles_selected))
            array_splice($this->roles_selected, array_search($id, $this->roles_selected), 1);
            //unset($this->roles_selected, array_search($this->roles_selected, [$id]));
        else
            array_push($this->roles_selected, $id);
    }

    public function updateRole()
    {
        User::find($this->selected_id)->roles()->sync($this->roles_selected);
        //$record->roles()->sync($this->roles);

        $this->resetInput();
        $this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'User Successfully updated.');
    }

    public function destroy($id)
    {
        if ($id) {
            User::where('id', $id)->delete();
        }
    }
}
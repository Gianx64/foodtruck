<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class SelfUpdate extends Component
{
    public $name, $email, $email_old, $password, $password_confirmation;

    public function render()
    {
        $record = User::findOrFail(auth()->user()->id);
		$this->name = $record-> name;
		$this->email = $record-> email;
		$this->email_old = $record-> email;

        return view('livewire.self-update');
    }

    public function update()
    {
        if (auth()->user()->id) {
            if ($this->email == $this->email_old)
                $this->validate(array_slice(User::$rules, 1), User::$message);
            else
                $this->validate(User::$rules, User::$message);
			User::find(auth()->user()->id)->update([ 
			'name' => $this-> name,
			'email' => $this-> email,
			'password' => Hash::make($this-> password)
            ]);

            redirect()->route('home')->with('success', 'User updated successfully.');
        }
    }
}

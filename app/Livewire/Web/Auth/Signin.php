<?php

namespace App\Livewire\Web\Auth;

use App\Livewire\Web\Pages\Home;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Signin extends Component
{
    public $email, $password;

    public function mount()
    {
        if (Auth::check()) {
            return $this->redirect(Home::class, true);
        }
    }

    public function login()
    {

        $this->validate([
            'email' => 'required:email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->reset(['email', 'password']);
            return $this->redirect(Home::class, true);
        }

        session()->flash('error', 'Invalid credentials');
    }

    public function render()
    {
        return view('livewire.web.auth.signin');
    }
}

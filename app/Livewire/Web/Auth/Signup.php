<?php

namespace App\Livewire\Web\Auth;

use App\Models\User;
use Livewire\Component;
use App\Livewire\Web\Pages\Home;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Signup extends Component
{

    public $name, $email, $password;

    public function mount()
    {
        if (Auth::check()) {
            return $this->redirect(Home::class, true);
        }
    }

    public function signup()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required:email|unique:users,email',
            'password' => 'required:min:6',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        if ($user) {
            Auth::login(User::where('email', $this->email)->first());
            $this->reset(['name', 'email', 'password']);
            return $this->redirect(Home::class, true);
        }

        session()->flash('error', 'Something went wrong. Please try again.');
    }

    public function render()
    {
        return view('livewire.web.auth.signup');
    }
}

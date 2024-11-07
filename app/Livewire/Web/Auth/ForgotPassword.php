<?php

namespace App\Livewire\Web\Auth;

use Livewire\Attributes\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Component
{
    #[Rule('required|email|exists:users,email')]
    public $email;

    public function forgotPassword()
    {
        $this->validate();

        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', 'Password reset link sent!');
    }

    public function render()
    {
        return view('livewire.web.auth.forgot-password');
    }
}

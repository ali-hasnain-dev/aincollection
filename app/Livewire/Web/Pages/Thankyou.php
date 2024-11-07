<?php

namespace App\Livewire\Web\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class Thankyou extends Component
{
    public function mount()
    {
        if (!session()->has('order-success')) {
            return $this->redirect(Home::class, true);
        }
    }
    public function render()
    {
        return view('livewire.web.pages.thankyou');
    }
}

<?php

namespace App\Livewire\Web\Commons;

use App\Livewire\Web\Pages\Home;
use Livewire\Component;

class Header extends Component
{
    public $items = [];
    public $data = [];

    public function logout()
    {
        auth()->logout();
        return $this->redirect(Home::class, true);
    }

    public function render()
    {
        return view('livewire.web.commons.header');
    }
}

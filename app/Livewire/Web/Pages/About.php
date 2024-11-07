<?php

namespace App\Livewire\Web\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class About extends Component
{
    #[Title('Posh - About Us')]

   public function placeholder()
    {
        return view('placeholders.homeplaceholder');
    }

    public function render()
    {
        return view('livewire.web.pages.about');
    }
}
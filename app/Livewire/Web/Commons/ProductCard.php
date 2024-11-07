<?php

namespace App\Livewire\Web\Commons;

use Livewire\Component;

class ProductCard extends Component
{
    public $item;

    public function mount($item)
    {
        $this->item = $item;
    }

    public function render()
    {
        return view('livewire.web.commons.product-card');
    }
}

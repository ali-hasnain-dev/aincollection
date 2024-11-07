<?php

namespace App\Livewire\Web\Commons;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class Search extends Component
{
    public $search = '';
    public $products = [];

    #[On('clearProducts')]
    public function clearProducts()
    {
        $this->products = [];
    }

    public function updatedSearch()
    {
        $this->products = [];
        $this->search = trim($this->search);
        if ($this->search) {
            $this->products = Product::with('category:id,slug')->select('id', 'name', 'slug', 'image', 'price', 'sale_price', 'product_category_id')->where('name', 'like', '%' . $this->search . '%')->where('is_visible', 1)->take(15)->get()->toArray();
        }
    }

    public function render()
    {
        return view('livewire.web.commons.search');
    }
}
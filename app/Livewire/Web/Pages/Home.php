<?php

namespace App\Livewire\Web\Pages;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    public $products;
    public function mount()
    {
        $this->products = Product::query()->with('category:id,slug')->select('id', 'name', 'slug', 'sku', 'description', 'image', 'price', 'sale_price', 'stock', 'allowed_quantity', 'tags', 'is_visible', 'product_category_id')->where('is_visible', 1)->latest()->limit(4)->get();
    }

    public function render()
    {
        return view('livewire.web.pages.home');
    }
}

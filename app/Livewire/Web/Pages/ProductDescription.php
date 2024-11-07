<?php

namespace App\Livewire\Web\Pages;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

class ProductDescription extends Component
{
    public $cateslug, $prodslug, $product, $discountPercentage;
    public $otherProducts = [];

    #[Title('Posh')]

    public function mount()
    {
        $this->product = Product::with([
            'category',
            'comments' => fn ($q) => $q->where('status', 1)
        ])->where([['slug', $this->prodslug], ['is_visible', 1]])->first();

        if ($this->product && $this->product->sale_price) {
            $this->discountPercentage = round((($this->product->price - $this->product->sale_price) / $this->product->price) * 100, 2);
            $this->otherProducts = Product::with('category')->where('product_category_id', $this->product->category_id)->inRandomOrder()->limit(4)->get();
        }
    }

    public function render()
    {
        return view('livewire.web.pages.product-description');
    }
}

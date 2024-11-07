<?php

namespace App\Livewire\Web\Commons;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;

class Cart extends Component
{
    public $items = [];

    public function mount()
    {
        $this->getCartData();
    }

    #[On('cartUpdated')]
    public function cartUpdated()
    {
        $this->getCartData();
    }

    public function getCartData()
    {
        $this->items = session()->get('cartData') ?? [];
    }

    #[On('addToCart')]
    public function addToCart($id, $quantity = '')
    {
        $quantity = !empty($quantity) ? $quantity : 1;
        $product = Product::with('category')->where('is_visible', 1)->find($id);
        if ($product) {
            if (array_key_exists($id, $this->items)) {
                if ($quantity > 1) {
                    $this->items[$id]['quantity'] = $quantity;
                } else {
                    $this->items[$id]['quantity'] += $quantity;
                }
            } else {
                $item = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'image' => $product->image,
                    'slug' => $product->slug,
                    'description' => $product->description,
                    'sale_price' => $product->sale_price,
                    'category_slug' => $product->category->slug
                ];

                $this->items[$item['id']] = $item;
            }

            session()->put('cartData', $this->items);
            $this->dispatch('notification', ['type' => 'success', 'message' => 'Product added to cart successfully.', 'id' => $id]);
        }
    }

    public function render()
    {
        return view('livewire.web.commons.cart');
    }
}

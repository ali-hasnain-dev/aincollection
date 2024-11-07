<?php

namespace App\Livewire\Web\Pages;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    public $cartItems = [];
    public $total = 0, $subTotal = 0, $discount = 0;
    public function mount()
    {
        $this->getCartData();
    }

    public function removeFromCart($item)
    {
        unset($this->cartItems[$item]);
        session()->put('cartData', $this->cartItems);
        $this->dispatch('cartUpdated');
        $this->getCartData();
    }

    public function getCartData()
    {
        $this->subTotal = $this->total = $this->discount = 0;
        $this->cartItems = session()->get('cartData') ?? [];
        if ($this->cartItems) {
            foreach ($this->cartItems as $key => $value) {
                $this->subTotal += $value['price'] * $value['quantity'];
                if ($value['sale_price']) {
                    $this->discount += (($value['price'] - $value['sale_price']) * $value['quantity']);
                }

                $this->cartItems[$key]['total'] = $value['price'] * $value['quantity'];
            }

            $this->total = $this->subTotal - $this->discount;
        }
    }

    #[On('updateNewToCart')]
    public function addToCart($id, $quantity)
    {
        $product = Product::with('category')->where('is_visible', 1)->find($id);
        if ($product) {
            $data = $this->cartItems;
            if (array_key_exists($id, $data)) {
                if ($quantity == 'increment' && $data[$id]['quantity'] >= 10) {
                    return false;
                }

                if ($quantity == 'decreament') {
                    $data[$id]['quantity'] -= 1;
                } elseif ($quantity == 'increment') {
                    $data[$id]['quantity'] += 1;
                }

                if ($data[$id]['quantity'] == 0) {
                    unset($data[$id]);
                    $this->dispatch('cartUpdated');
                }
            } else {
                $item = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'image' => $product->image,
                    'slug' => $product->slug,
                    'description' => $product->description,
                    'sale_price' => $product->sale_price,
                    'category_slug' => $product->category->slug
                ];

                $data[$item['id']] = $item;
            }

            session()->put('cartData', $data);
            $this->getCartData();
        }
    }

    public function clearCart()
    {
        session()->forget('cartData');
        $this->dispatch('cartUpdated');
        $this->getCartData();
    }

    public function render()
    {
        return view('livewire.web.pages.cart');
    }
}

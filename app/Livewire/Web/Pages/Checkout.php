<?php

namespace App\Livewire\Web\Pages;

use App\Models\Order;
use App\Models\ShippingAdress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Checkout extends Component
{
    public $total = 0, $subTotal = 0, $discount = 0;
    public $cartItems = [];
    public $name = '', $email = '', $phone = '', $state = '', $city = '', $zipCode = '', $address = '', $comment = '', $saveInfo = '';
    public function mount()
    {
        if (!session()->has('cartData') || count(session()->get('cartData')) == 0) {
            return $this->redirect(Home::class, true);
        }

        $shippingAddress = ShippingAdress::where('default', 1)->where('user_id', Auth::id())->first();
        if ($shippingAddress) {
            $this->name = $shippingAddress->name;
            $this->email = $shippingAddress->email;
            $this->phone = $shippingAddress->phone;
            $this->state = $shippingAddress->state;
            $this->city = $shippingAddress->city;
            $this->zipCode = $shippingAddress->zip_code;
            $this->address = $shippingAddress->address;
            $this->saveInfo = true;
        }

        $this->getCartData();
    }

    public function getCartData()
    {
        $this->subTotal = 0;
        $this->total = 0;
        $this->discount = 0;
        $this->cartItems = session()->get('cartData') ?? [];
        if ($this->cartItems) {
            foreach ($this->cartItems as $key => $value) {
                $this->subTotal += $value['price'] * $value['quantity'];
                if ($value['sale_price'] > 0) {
                    $this->discount += ($value['price'] - $value['sale_price']) * $value['quantity'];
                }

                $this->cartItems[$key]['total'] = $value['price'] * $value['quantity'];
            }

            $this->total = $this->subTotal - $this->discount + 250;
        }
    }

    public function placeOrder()
    {
        DB::beginTransaction();
        try {

            $this->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'state' => 'required',
                'city' => 'required',
                'zipCode' => 'required',
                'address' => 'required',
            ]);

            $order = Order::create([
                'order_number' => random_int(1000000, 9999999),
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'state' => $this->state,
                'city' => $this->city,
                'zip_code' => $this->zipCode,
                'address' => $this->address,
                'comment' => $this->comment,
                'user_id' => Auth::id(),
            ]);

            foreach ($this->cartItems as $key => $value) {
                $price = $value['sale_price'] > 0 ? $value['sale_price'] : $value['price'];
                $order->oderItems()->create([
                    'product_id' => $value['id'],
                    'quantity' => $value['quantity'],
                    'item_price' => $price,
                    'item_total' => $price * $value['quantity'],
                ]);
            }


            if ($this->saveInfo) {
                ShippingAdress::updateOrCreate([
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'state' => $this->state,
                    'city' => $this->city,
                    'zip_code' => $this->zipCode,
                    'address' => $this->address,
                    'default' => 1,
                    'user_id' => Auth::id(),
                ]);
            } else {
                $shippingAddress = ShippingAdress::where('default', 1)->where('user_id', Auth::id())->first();
                if ($shippingAddress) {
                    $shippingAddress->default = 0;
                    $shippingAddress->save();
                }
            }

            DB::commit();
            session()->forget('cartData');
            session()->flash('order-success', 'Order placed successfully');
            $this->redirect(Thankyou::class, true);
        } catch (\Exception $exception) {
            Log::error("message: {$exception->getMessage()}; trace: {$exception->getTraceAsString()}");
            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.web.pages.checkout');
    }
}

<div class="w-full">
    <div class="flex justify-between items-center w-full md:w-2/3 m-2">
        <h1 class="text-3xl font-bold h-10">Shopping Cart</h1>
        @if (count($cartItems) > 0)
            <p class="text-md underline underline-offset-2 hover:no-underline font-semibold text-red-600 hover:text-red-500 cursor-pointer"
                wire:click="clearCart" wire:loading.remove wire:target="clearCart">Clear Cart</p>
            <div wire:loading wire:target="clearCart">
                <div role="status">
                    <svg aria-hidden="true"
                        class="inline w-6 h-6 text-gray-400 animate-spin dark:text-gray-500 fill-red-500"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                </div>
            </div>
        @endif
    </div>
    <div class="flex flex-col md:flex-row md:space-x-14 w-full items-start">
        @if (count($cartItems) > 0)
            <div class="w-full md:w-2/4 flex-grow">
                @foreach ($cartItems as $item)
                    <hr class="my-8">
                    <div class="flex justify-between w-full space-x-3 " wire:key='{{ $item['id'] }}'>
                        <div class=" flex sm:flex-row flex-col space-x-4">
                            <img src="{{ asset('storage/' . $item['image']) }}" class="rounded-lg h-40 w-60 md:h-52"
                                alt="product image">
                            <div class="flex flex-col space-y-4">
                                <a href="{{ route('product-description', [$item['category_slug'], $item['slug']]) }}"
                                    wire:navigate
                                    class="text-md md:text-xl font-semibold text-black underline">{{ $item['name'] }}</a>
                                <div class="flex-grow">
                                    @if ($item['sale_price'])
                                        <span
                                            class="text-xl font-bold mr-2 {{ $item['sale_price'] ? 'text-green-500' : 'text-gray-600' }}">Rs.{{ $item['sale_price'] }}</span>
                                    @endif

                                    <span
                                        class="text-lg text-gray-500 {{ $item['sale_price'] ? 'line-through' : '' }}">Rs.{{ $item['price'] }}</span>
                                </div>
                                <div class="w-full flex items-center space-x-3">
                                    <button
                                        wire:click="$dispatch('updateNewToCart', { id: {{ $item['id'] }}, quantity: 'decreament' })"
                                        class="{{ $item['quantity'] <= 1 ? 'cursor-not-allowed' : '' }}  hover:bg-opacity-70 rounded-full py-2 px-1 w-10 bg-black font-bold text-white"
                                        {{ $item['quantity'] == 1 ? 'disabled' : '' }}>-</button>
                                    <p>{{ $item['quantity'] }}</p>
                                    <button
                                        wire:click="$dispatch('updateNewToCart', { id: {{ $item['id'] }}, quantity: 'increment' })"
                                        class="{{ $item['quantity'] >= 10 ? 'cursor-not-allowed' : '' }} hover:bg-opacity-70 rounded-full py-2 px-1 w-10 bg-black text-white font-bold "
                                        {{ $item['quantity'] >= 10 ? 'disabled' : '' }}>+</button>
                                </div>
                            </div>
                        </div>
                        <div class="flex">
                            <p class="cursor-pointer text-black font-extrabold"
                                wire:click="removeFromCart({{ $item['id'] }})" wire:loading.remove
                                wire:target="removeFromCart({{ $item['id'] }})">
                                <i class="fa-solid fa-xmark"></i>
                            </p>
                            <div wire:loading wire:target="removeFromCart({{ $item['id'] }})">
                                <div role="status">
                                    <svg aria-hidden="true"
                                        class="inline w-4 h-4 text-gray-400 animate-spin dark:text-gray-600 fill-black"
                                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor" />
                                        <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                            fill="currentFill" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="w-full mt-5 md:w-1/4 3xl:w-1/3 flex flex-col p-6 bg-gray-100 rounded-lg shadow-sm">
                <h1 class="text-lg font-semibold">Cart Summary</h1>

                <div class="flex flex-col">
                    <div class="w-full flex justify-between mt-5">
                        <p class="text-gray-500">Sub Total</p>
                        <p>Rs.{{ $subTotal }}</p>
                    </div>
                    <hr class="my-4">
                    <div class="w-full flex justify-between">
                        <p class="text-gray-500">Discount</p>
                        <p>{{ $discount > 0 ? "- Rs.$discount " : '-' }}</p>
                    </div>
                    <hr class="my-4">
                    <div class="w-full flex justify-between">
                        <p class="font-semibold">Total</p>
                        <p class="font-semibold">Rs.{{ $total }}</p>
                    </div>
                </div>

                <div class="flex justify-center items-center mt-8">
                    @auth
                        <a href="{{ route('checkout') }}" wire:navigate
                            class="w-full p-2 font-semibold bg-green-500  border-orange-400 text-white rounded-lg text-center hover:bg-white hover:text-green-500 hover:border hover:border-green-500">Checkout</a>
                    @else
                        <a href="{{ route('login') }}" wire:navigate
                            class="w-ful rounded-lg text-center underline hover:no-underline">Login
                            to proceed</a>
                    @endauth
                </div>
            </div>
        @else
            <div class="flex-grow flex items-center justify-center">
                <div class="w-full md:w-1/3">
                    <div class="flex justify-center items-center h-full">
                        <img src="{{ asset('web/empty-cart.png') }}" alt="">
                    </div>
                    <div
                        class="flex justify-center items-center my-2 space-x-1 text-xl font-semibold text-black hover:underline hover:underline-offset-3 hover:font-bold">
                        <a href="{{ route('home') }}" wire:navigate class="">Let's
                            Shopping </a>
                        <i class="fa-solid fa-arrow-right  pt-2"></i>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

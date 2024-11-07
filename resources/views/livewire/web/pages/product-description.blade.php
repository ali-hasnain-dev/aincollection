<head>
    {{-- @if ($product->tags)
        @foreach ($product->tags as $tag)
            <meta name="{{ $product->name }}" content="{{ $tag }}">
        @endforeach
    @endif --}}
</head>

<div class="w-10/12 mx-auto">
    <div class="flex flex-col sm:items-start items-center justify-start max-h-full sm:flex-row">
        <!-- Product Image Section -->
        <div class="flex justify-center sm:justify-start items-center mb-4 sm:mb-0">
            <img width="400" height="400" src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                class="max-w-full h-64 rounded-lg">
        </div>
        <!-- Product Information Section -->
        <!-- Product Title, Price, Discount Price, and Tags -->
        <div class="flex flex-col justify-center items-start sm:ml-10" x-data="{ quantity: 1 }">
            <h1 class="text-xl font-semibold mb-4">{{ $product->name }}</h1>
            <div class="flex mb-4">
                <span
                    class="text-xl font-bold mr-2 {{ $product->sale_price ? 'text-green-500' : 'text-gray-600' }}">Rs.{{ $product->sale_price ?? $product->price }}</span>
                @if ($product->sale_price)
                    <span
                        class="text-lg line-through text-gray-500">Rs.{{ $product->sale_price ? $product->price : '' }}</span>
                    <span class="ml-2 bg-yellow-500 text-white px-2 py-1 rounded">-{{ $discountPercentage }}%</span>
                @endif
            </div>

            <p class="font-semibold {{ $product->stock > 0 ? 'text-green-500' : 'text-red-500' }}">
                {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</p>

            @if ($product->stock)
                <div class="mt-4 mb-4 flex justify-between items-center ">
                    <div class="mt-4 mb-4 flex justify-center items-center space-x-3">
                        <button class="text-white rounded-full w-8 h-8 bg-black font-bold"
                            x-on:click="quantity>1?quantity--:''" :disabled="quantity === 1">-</button>
                        <h1 class="font-semibold text-2xl" x-text="quantity"></h1>
                        <button class="text-white rounded-full w-8 h-8 bg-black font-bold"
                            x-on:click="quantity<{{ $product->allowed_quantity ?? $product->stock }}?quantity++:''"
                            :disabled="quantity === {{ $product->allowed_quantity ?? $product->stock }}">+</button>
                    </div>
                </div>

                <div class="w-full" @click="$dispatch('addToCart', { id: {{ $product->id }}, quantity:  quantity })">
                    <button onclick="addbutton({{ $product->id }})" id='prod-{{ $product->id }}'
                        class="bg-black hover:bg-gray-800 text-white px-4 py-2 rounded-md font-semibold">Add
                        to Bag</button>
                    <button style="display: none"
                        class="text-white px-4 py-2 rounded-md border border-black addToCardDesc-{{ $product->id }}">
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
                            <span class="text-black font-bold"> Adding</span>
                        </div>
                    </button>
                </div>
            @endif

        </div>
    </div>

    <!-- Product Description Section -->
    @if (!empty($product->description))
        <div class="flex flex-col max-h-full mt-16">
            <h2 class="text-xl font-semibold mb-4">Product Description</h2>
            <p class="text-gray-700">
                {{ $product->description }}
            </p>
        </div>
    @endif

    <!-- Comment Section -->
    <div class="mb-8 mt-14">
        <h2 class="text-2xl font-semibold mb-4">Customer Reviews</h2>
        <div class="space-y-4">
            @if (count($product->comments) > 0)
                @foreach ($product->comments as $comment)
                    <div class="w-3/4">
                        <strong>John Doe</strong>
                        <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                    <hr>
                @endforeach
            @else
                <p class="text-gray-500 ml-3 font-semibold">No review yet.</p>
            @endif
            <!-- Additional comments go here -->
        </div>
    </div>

    @if (count($otherProducts) > 0)
        <div class="mb-8 mt-14">
            <h2 class="text-2xl font-semibold mb-4">Other Related Products</h2>
            <div class="space-y-4">
                <div class="grid grid-cols-2 xl:grid-cols-4 md:grid-cols-3 sm:grid-cols-4 gap-16 justify-evenly">
                    @foreach ($otherProducts as $item)
                        <livewire:web.commons.product-card :item="$item" :key="$item->id" />
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>

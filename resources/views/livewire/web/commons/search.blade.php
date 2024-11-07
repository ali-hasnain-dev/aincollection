<div
    x-data='{showSearch:false,
    handleEscape() {
        this.showSearch=false;
        $wire.search="";
        $wire.dispatch("clearProducts");
        $wire.products=[];
    },

}'>

    <i @click="showSearch=true" wire:click="search"
        class="fa-solid fa-magnifying-glass hover:cursor-pointer mt-1 hover:text-gray-400"
        @keydown.escape.window="handleEscape"></i>

    @teleport('body')
        <div x-show="showSearch" x-trap="showSearch" class="relative z-10" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-80 transition-opacity"></div>
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex justify-center p-4 sm:p-0">
                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 w-full md:max-w-2xl">
                        <div class="flex items-start justify-end mt-3 mr-3 cursor-pointer " @click="handleEscape">
                            <i class="fa-solid fa-xmark text-red-600 font-semibold" title="Close"></i>
                        </div>
                        <div @click.outside="handleEscape" class="bg-white px-4 pb-4 sm:p-6 sm:pb-4">
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <!-- Changed 'left-0' to 'right-0' -->
                                    <div role="status" wire:loading wire:target="search">
                                        <svg aria-hidden="true"
                                            class="inline w-6 h-6 text-gray-400 animate-spin dark:text-gray-600 fill-orange-400"
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
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                                    wire:loading.remove>
                                    <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                @if ($search)
                                    <div wire:loading.remove
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                                        @click="$wire.search=''; $wire.dispatch('clearProducts');">
                                        <i class="fa-solid fa-xmark w-5 h-5 text-gray-500"></i>
                                    </div>
                                @endif
                                <input wire:model.live.debounce.500ms="search" type="text"
                                    class="w-full rounded-md border-gray-300 border-2 p-3 pl-10" placeholder="Search...">
                            </div>

                            <div class="w-full m-3 min-h-full" wire:loading.remove>
                                <div class="w-full flex items-center space-x-3 justify-center ">
                                    Most popular: soap, new, brand
                                </div>
                                @if (strlen($search) > 1 && count($products) > 0)
                                    <div class="w-full flex flex-col">
                                        <p class="text-orange-500 font-serif text-lg m-2">Results.</p>
                                    </div>
                                    <div class="w-full mt-3 flex flex-col overflow-auto">
                                        @foreach ($products as $product)
                                            <a href="{{ route('product-description', [$product['category']['slug'], $product['slug']]) }}"
                                                wire:navigate class="hover:cursor-pointer hover:bg-slate-50">
                                                <div class="w-full flex justify-between items-center p-3">
                                                    <div class="flex space-x-2">
                                                        <img width="70" class="rounded"
                                                            src="{{ asset('storage/' . $product['image']) }}"
                                                            alt="">
                                                        <p class="text-gray-500">{{ $product['name'] }}</p>
                                                    </div>
                                                    <p>Rs.{{ $product['sale_price'] ?? $product['price'] }}</p>
                                                </div>
                                            </a>
                                            <hr class="my-2">
                                        @endforeach
                                    </div>
                                @else
                                    <div class="flex justify-center items-center">
                                        <p class="text-gray-500 mt-8 mb-3">
                                        <div class="flex flex-col mt-5">
                                            <img width="100" src="{{ $search ? asset('web/icons8-cross.svg') : '' }}"
                                                alt="">
                                            <p class="mt-2 font-semibold">
                                                {{ $search ? 'No results found.' : '' }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endteleport
</div>

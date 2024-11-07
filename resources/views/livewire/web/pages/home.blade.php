<section class="">
    <div class="mb-3 w-full">
        <img hight="400" src="https://source.unsplash.com/1600x400/?beauty" alt="">
    </div>
    <h1 class="text-2xl font-semibold dark:text-white my-8">Featured Products</h1>
    <div class="grid grid-cols-2 xl:grid-cols-4 md:grid-cols-3 sm:grid-cols-4 gap-16 justify-evenly">
        @foreach ($products as $item)
            <livewire:web.commons.product-card :item="$item" :key="$item->id" />
        @endforeach
    </div>

    <div
        class="w-full flex flex-col md:flex-row md:justify-between justify-center items-center bg-fuchsia-100 min-h-full p-5 m-3">
        <h1 class="text-2xl font-semibold mb-4 md:mb-0 md:mr-2">Stay up to date</h1>
        <div
            class="w-full md:w-1/2 flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 items-center md:justify-end">
            <input type="text" class="rounded-md border-gray-300 p-2 w-full " placeholder="Enter your email">
            <button class="text-white font-bold border-2 rounded-md bg-black p-2 hover:bg-gray-700">Subscribe</button>
        </div>
    </div>
</section>

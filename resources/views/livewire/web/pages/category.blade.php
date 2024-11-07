<div>
    <div class="grid grid-cols-2 xl:grid-cols-4 md:grid-cols-3 sm:grid-cols-4 gap-16 justify-evenly">
        @foreach ($products as $item)
            <livewire:web.commons.product-card :item="$item" :key="$item->id" />
        @endforeach
    </div>
    {{ $products->links() }}
</div>

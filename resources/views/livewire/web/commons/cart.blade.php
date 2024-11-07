<div class="flex items-center space-x-3">
    <livewire:web.commons.search />
    <div class="flex items-center relative">
        <a href="{{ route('cart') }}" wire:navigate class="text-xl hover:text-gray-300">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 18 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9V4a3 3 0 0 0-6 0v5m9.92 10H2.08a1 1 0 0 1-1-1.077L2 6h14l.917 11.923A1 1 0 0 1 15.92 19Z" />
            </svg>
        </a>
        <small
            class="bg-white text-orange-400 rounded-full -top-2.5 left-5 absolute font-extrabold">{{ count($items) > 0 ? count($items) : '' }}</small>
    </div>
</div>

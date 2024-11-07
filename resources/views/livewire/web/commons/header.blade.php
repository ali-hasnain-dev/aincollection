<div class="w-full top-0 sticky mb-3 bg-white ">
    <div
        class="w-full mt-3 mb-6 px-4 md:px-8 lg:px-16 xl:px-32 2xl:px-64 h-4 md:flex justify-end md:justify-between items-center hidden">
        <div class="hidden md:flex md:justify-center  items-center space-x-2">
            <p class="text-xs font-semibold text-gray-700"><i class="fa-solid fa-mobile-screen"></i> 0300-123456</p>
            <span class="font-bold">|</span>
            <p class="text-xs font-semibold text-gray-700 "><i class="fa-solid fa-envelope mr-1"></i>
                contact@gmail.com</p>
        </div>
        @auth
            <div class="flex items-center space-x-1">
                <a href="{{ route('profile') }}" wire:navigate
                    class="text-gray-500 hover:text-gray-700 text-xs font-semibold {{ request()->is('profile') ? 'underline font-extrabold' : '' }}">Profile</a>
                <span>|</span>
                <a wire:click.prevent='logout'
                    class="text-red-600 hover:text-gray-600 text-xs font-semibold hover:cursor-pointer ">Logout</a>
            </div>
        @else
            <div class="flex items-center space-x-1">
                <a href="{{ route('login') }}" wire:navigate
                    class="hover:text-bold text-xs font-semibold {{ request()->is('login') ? ' font-extrabold' : '' }}">Login</a>
                <span class="font-bold">|</span>
                <a href="{{ route('signup') }}" wire:navigate
                    class="hover:text-bold text-xs font-semibold {{ request()->is('signup') ? ' font-extrabold' : '' }}">Register</a>
            </div>
        @endauth
    </div>

    <nav
        class="flex justify-between w-full top-16 px-4 md:px-8 lg:px-16 xl:px-32 2xl:px-64 bg-white h-14 md:h-10 items-center">
        <div class="flex justify-center items-center space-x-2 md:space-x-3">
            <!-- Mobile menu toggle button -->
            <button id="mobile-menu-button" class="md:hidden focus:outline-none mt-2">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            <a href="{{ route('home') }}" wire:navigate class="flex">
                <img width="33" class=" sm:block" src="{{ asset('web/logo1.png') }}" alt="logo">
                <img width="100" class="hidden md:block" src="{{ asset('web/logo2.png') }}" alt="logo">
            </a>
        </div>
        <div class="hidden md:flex text-gray-600  dark:text-white space-x-6 text-sm font-semibold" wire:navigate.self>
            <a href="{{ route('home') }}" wire:navigate
                class="hover:text-gray-700 {{ request()->routeIs('home') ? 'font-bold text-gray-950 underline underline-offset-8' : '' }}">Home</a>
            <a href="{{ route('about-us') }}" wire:navigate
                class="hover:text-gray-700 {{ request()->routeIs('about-us') ? 'font-bold text-gray-950 underline underline-offset-8' : '' }}">About
                us</a>
            <a href="{{ route('contact-us') }}" wire:navigate
                class="hover:text-gray-700 {{ request()->routeIs('contact-us') ? 'font-bold text-gray-950 underline underline-offset-8' : '' }}">Contact
                us</a>
        </div>

        <livewire:web.commons.cart />
    </nav>

    <!-- Mobile navigation -->
    <div class="md:hidden">
        <!-- Mobile sidebar -->
        <div id="mobile-sidebar"
            class="hidden md:hidden fixed top-0 left-0 h-screen w-1/2 bg-white z-50 overflow-hidden shadow-lg border rounded-lg flex-col">
            <div class="flex justify-center items-center mt-5">
                <a href="{{ route('home') }}" wire:navigate class="flex">
                    <img width="33" class=" block" src="{{ asset('web/logo1.png') }}" alt="logo">
                    <img width="100" class=" block" src="{{ asset('web/logo2.png') }}" alt="logo">
                </a>
            </div>
            <hr class="mt-3 mb-3">
            <div class="text-black dark:text-white space-y-4 text-sm font-semibold p-4 flex flex-col">
                <div class="flex flex-col space-y-4">
                    <div
                        class="flex items-center space-x-2 hover:font-bold {{ request()->routeIs('home') ? 'font-bold underline-offset-1' : '' }}">
                        <i class="fa-solid fa-house"></i>
                        <a href="{{ route('home') }}" wire:navigate>Home</a>
                    </div>
                    <div
                        class="flex items-center space-x-2 hover:font-bold {{ request()->routeIs('about-us') ? 'font-extrabold' : '' }}">
                        <i class="fa-solid fa-circle-info"></i>
                        <a href="{{ route('about-us') }}" wire:navigate>About
                            us</a>
                    </div>
                    <div
                        class="flex items-center space-x-2 hover:font-bold {{ request()->routeIs('contact-us') ? 'font-extrabold' : '' }}">
                        <i class="fa-solid fa-address-book"></i>
                        <a href="{{ route('contact-us') }}" wire:navigate>Contact
                            us</a>
                    </div>
                </div>
            </div>
            <!-- Login and Registration Buttons at the bottom -->
            <div class="mt-auto p-4">
                <div class="flex justify-center space-x-2 items-center">
                    <a href="{{ route('login') }}" wire:navigate
                        class="hover:text-bold text-sm font-semibold {{ request()->is('login') ? ' font-extrabold' : '' }}">Login</a>
                    <span class="font-bold">|</span>
                    <a href="{{ route('signup') }}" wire:navigate
                        class="hover:text-bold text-sm font-semibold {{ request()->is('signup') ? 'font-extrabold' : '' }}">Register</a>
                </div>
            </div>
        </div>
    </div>

    <hr class="mt-1">
</div>

@script
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileSidebar = document.getElementById('mobile-sidebar');

        mobileMenuButton.addEventListener('click', function() {
            mobileSidebar.classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            const isClickInside = mobileSidebar.contains(event.target) || mobileMenuButton.contains(event.target);

            if (!isClickInside && !mobileSidebar.classList.contains('hidden')) {
                mobileSidebar.classList.add('hidden');
            }
        });
    </script>
@endscript

<footer class="bg-gray-100">
    <div class="flex flex-col items-center space-y-8  mt-8 md:flex-row md:justify-evenly md:items-start md:space-y-0">
        <div class="text-gray-700 dark:text-white text-center">
            <h1 class="text-xl font-bold mb-0">NEED HELP?</h1>
            <div class="flex flex-col mt-2 md:mt-4 space-y-2 font-semibold">
                <p class="text-sm font-semibold"><i class="fa-solid fa-mobile-screen"></i> 0300-123456</p>
                <p class="text-sm font-semibold"><i class="fa-solid fa-envelope"></i> contact@gmail.com</p>
            </div>
        </div>

        <div class="text-gray-700 dark:text-white text-center">
            <h1 class="text-xl font-bold mb-0">Customer Service</h1>
            <div class="flex flex-col mt-2 md:mt-4 space-y-2 font-semibold">
                <a href="{{ route('contact-us') }}" wire:navigate>Contact us</a>
            </div>
        </div>
        <div class="text-gray-700 dark:text-white text-center">
            <h1 class="text-xl font-bold mb-0">Company</h1>
            <div class="flex flex-col mt-2 space-y-2 font-semibold">
                <a href="{{ route('home') }}" wire:navigate>Home</a>
                <a href="{{ route('about-us') }}" wire:navigate>About us</a>
                <a href="{{ route('contact-us') }}" wire:navigate>Contact us</a>
            </div>
        </div>
        <div class="text-gray-700 sm:items-center dark:text-white text-center">
            <h1 class="text-xl font-bold mb-0">Follow us</h1>
            <div class="flex space-x-1 mt-2">
                <a href="{{ route('about-us') }}">
                    <img width="50" height="50" src="https://img.icons8.com/bubbles/50/facebook-new.png"
                        alt="facebook-new" />
                </a>
                <a href="{{ route('about-us') }}"><img width="50" height="50"
                        src="https://img.icons8.com/bubbles/50/instagram-new--v2.png" alt="instagram-new--v2" /></a>
            </div>
        </div>
    </div>
    <hr>

    <div class="text-gray-700 dark:text-white text-center py-4 mt-5 font-bold">
        © {{ date('Y') }} POSH
    </div>
</footer>

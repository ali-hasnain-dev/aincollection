<div class="w-full md:w-[450px] mx-auto my-auto flex items-center justify-center">
    <div class="p-5 rounded-lg shadow-xl w-full border border-gray-300 bg-white">
        <h1 class="text-lg xl:text-xl font-semibold mb-6 text-center">SignUp</h1>
        <!-- Login Form -->
        <form wire:submit.prevent='signup' class="flex flex-col gap-3">
            <p class="text-red-500 font-normal text-xs mb-3">{{ session()->get('error') }}</p>
            <div class="flex flex-col gap-2">
                <label for="name" class="block text-sm font-medium text-gray-600">Name <span
                        class="text-red-500 font-xs">*</span></label>
                <input type="text" id="name" name="name"
                    class="mt-1 p-2 w-full border rounded-md outline-none {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}"
                    placeholder="Enter the name" wire:model='name' required>
                <span class="text-red-500 font-normal text-xs">{{ $errors->first('name') }}</span>
            </div>

            <div class="flex flex-col gap-2">
                <label for="email" class="block text-sm font-medium text-gray-600">Email <span
                        class="text-red-500 font-xs">*</span></label>
                <input type="email" id="email" name="email"
                    class="mt-1 p-2 w-full border rounded-md outline-none {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}"
                    placeholder="Enter the email" wire:model='email' required>
                <span class="text-red-500 font-normal text-xs">{{ $errors->first('email') }}</span>
            </div>

            <div class="flex flex-col gap-2">
                <label for="password" class="block text-sm font-medium text-gray-600">Password <span
                        class="text-red-500 font-xs">*</span></label>
                <input type="password" id="password" name="password"
                    class="mt-1 p-2 w-full border rounded-md outline-none {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }}"
                    placeholder="Enter the password" wire:model='password' required>
                <span class="text-red-500 font-normal text-xs">{{ $errors->first('password') }}</span>
            </div>
            <button wire:loading.remove type="submit"
                class="w-full bg-black text-white p-2 rounded-md hover:bg-gray-800">SignUp</button>
            <button wire:loading class="w-full bg-black text-white p-2 rounded-md hover:bg-gray-800">
                <div role="status">
                    <svg aria-hidden="true"
                        class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                    <span class="sr-only">Loading...</span> Sign Up
                </div>
            </button>
        </form>

        <!-- Signup and Forget Password Options -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Already have account? <a href="{{ route('login') }}" wire:navigate
                    class="font-bold hover:underline">SignIn</a></p>
        </div>
    </div>
</div>

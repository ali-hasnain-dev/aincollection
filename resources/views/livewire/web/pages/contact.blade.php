<div class="w-full md:w-[600px] mx-auto my-auto flex items-center justify-center">
    <div class="p-5 border rounded-lg shadow-lg m-3 w-full bg-white">
        <div class="flex justify-center items-center">
            <h1 class="text-lg xl:text-xl font-semibold">Contact Us</h1>
        </div>
        <div class="flex justify-center items-center mt-2">
            <p class="font-normal mt-1 text-sm font-serif mb-3 text-fuchsia-500">"We would love to hear from you."</p>
        </div>
        <form wire:submit.prevent='submitContact' class="flex flex-col gap-3">
            <div class="mb-4 mt-2 flex justify-center items-center">
                <p class="text-red-500 font-bold text-xs mb-3">{{ session()->get('error') }}</p>
                <p class="text-green-500 font-bold text-xs mb-3">{{ session()->get('success') }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <label for="name" class=" block text-md font-medium text-gray-600">Name <span
                        class="text-red-500 font-xs">*</span></label>
                <input type="text"
                    class="mt-1 p-2 w-full border rounded-md outline-none {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}"
                    placeholder="Enter the name" wire:model='name' required>
                <span class="text-red-500 font-normal text-xs">{{ $errors->first('name') }}</span>
            </div>
            <div class="flex flex-col gap-2">
                <label for="name" class=" block text-md font-medium text-gray-600">Email <span
                        class="text-red-500 font-xs">*</span></label>
                <input type="email"
                    class="mt-1 p-2 w-full border rounded-md outline-none {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}"
                    placeholder="Enter the email" wire:model='email' required>
                <span class="text-red-500 font-normal text-xs">{{ $errors->first('email') }}</span>
            </div>
            <div class="flex flex-col gap-2">
                <label for="name" class=" block text-md font-medium text-gray-600">Phone</label>
                <input type="number" class="mt-1 p-2 w-full border rounded-md outline-none"
                    placeholder="Enter the phone" wire:model='phone'>
                <span class="text-red-500 font-normal text-xs">{{ $errors->first('phone') }}</span>
            </div>
            <div class="flex flex-col gap-2">
                <label for="name" class=" block text-md font-medium text-gray-600">Subject <span
                        class="text-red-500 font-xs">*</span></label>
                <textarea name="" id="" cols="30" rows="6"
                    class="mt-1 p-2 w-full border rounded-md outline-none {{ $errors->has('subject') ? 'border-red-500' : 'border-gray-300' }}"
                    placeholder="Enter the subject" style="resize: none" wire:model='subject' required></textarea>
                <span class="text-red-500 font-normal text-xs">{{ $errors->first('subject') }}</span>
            </div>
            <button type="submit" class=" bg-black hover:bg-gray-800 text-white p-2 rounded-md ">Submit
                Query</button>
        </form>
    </div>
</div>

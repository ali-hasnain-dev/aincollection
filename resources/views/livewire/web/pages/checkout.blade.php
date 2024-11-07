<div class="w-full ">
    <div class="flex items-lefy justify-left">
        <h1 class="md:text-2xl text-3xl font-bold h-10 mb-5">Checkout</h1>
    </div>
    <div class="flex flex-col md:flex-row md:space-x-14 w-full items-star">
        <div class="w-full rounded-lg shadow-lg border bg-white">
            <form action="" class="m-4" wire:submit='placeOrder'>
                <h1 class="text-md font-bold mx-3 text-green-600">Cotact Information</h1>
                <div class="w-full flex flex-col md:flex-row md:justify-between items-center md:space-x-10 p-2">

                    <div class="w-full md:w-1/2">
                        <label for="name" class="m-2 block text-sm font-medium text-gray-600">Name</label>
                        <input type="text" placeholder="Enter Name."
                            class="w-full rounded-md border-2 p-2 m-2 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}"
                            name="name" id="name" maxlength="100" required wire:model='name'>
                        <span class="text-red-500 font-normal text-xs">{{ $errors->first('name') }}</span>
                    </div>

                    <div class="w-full md:w-1/2">
                        <label for="email" class="m-2 block text-sm font-medium text-gray-600">Email</label>
                        <input type="email" placeholder="Enter Email."
                            class="w-full rounded-md border-2 p-2 m-2 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}"
                            name="email" id="email" required wire:model='email'>
                        <span class="text-red-500 font-normal text-xs">{{ $errors->first('email') }}</span>
                    </div>

                </div>

                <div class="w-full flex flex-col md:flex-row md:justify-between items-center md:space-x-10 p-1">
                    <div class="w-full md:w-1/2">
                        <label for="" class="m-2 block text-sm font-medium text-gray-600">Phone No.</label>
                        <input type="text" placeholder="Enter Phone No."
                            class="w-full rounded-md border-2 p-2 m-2 {{ $errors->has('phone') ? 'border-red-500' : 'border-gray-300' }}"
                            name="phone" id="phone" maxlength="100" required wire:model='phone'>
                        <span class="text-red-500 font-normal text-xs">{{ $errors->first('phone') }}</span>
                    </div>
                    <div class="w-full md:w-1/2">

                    </div>
                </div>
                <h1 class="text-md font-bold mx-3 text-green-600 my-3">Shipping Information</h1>


                <div class="w-full flex flex-col md:flex-row md:justify-between md:items-center md:space-x-10 p-2">
                    <div class="w-full md:w-1/2">
                        <label for="state" class="m-2 block text-sm font-medium text-gray-600">State</label>
                        <select name="state" id="state"
                            class="w-full border p-2 rounded-md select2 {{ $errors->has('state') ? 'border-red-500' : 'border-gray-300' }}"
                            required wire:model='state'>
                            <option value="">Select State</option>
                            <option value="punjab" @if ($state == 'punjab') selected @endif>Punjab</option>
                            <option value="sindh" @if ($state == 'sindh') selected @endif>Sindh</option>
                            <option value="kpk" @if ($state == 'kpk') selected @endif>KPK</option>
                            <option value="balochistan" @if ($state == 'balochistan') selected @endif>Balochistan
                            </option>
                        </select>
                        <span class="text-red-500 font-normal text-xs">{{ $errors->first('state') }}</span>
                    </div>

                    <div class="w-full md:w-1/2">
                        <label for="city" class="m-2 block text-sm font-medium text-gray-600">City</label>
                        <input type="text" placeholder="Enter City."
                            class="w-full rounded-md border-2 p-2 m-2 {{ $errors->has('city') ? 'border-red-500' : 'border-gray-300' }}"
                            name="city" id="city" maxlength="100" required wire:model='city'>
                        <span class="text-red-500 font-normal text-xs">{{ $errors->first('city') }}</span>
                    </div>
                </div>

                <div class="w-full flex flex-col md:flex-row md:justify-between items-center md:space-x-10 p-1">
                    <div class="w-full md:w-1/2">
                        <label for="zip_code" class="m-2 block text-sm font-medium text-gray-600">Zip Code.</label>
                        <input type="text" placeholder="Enter zip code."
                            class="w-full rounded-md border-2 p-2 m-2 {{ $errors->has('zipCode') ? 'border-red-500' : 'border-gray-300' }}}"
                            name="zip_code" id="zip_code" maxlength="3" wire:model='zipCode'>
                        <span class="text-red-500 font-normal text-xs">{{ $errors->first('zipCode') }}</span>
                    </div>
                    <div class="w-full md:w-1/2">

                    </div>
                </div>

                <div class="w-full flex flex-col md:flex-row md:justify-between items-center md:space-x-10 p-1">
                    <div class="w-full">
                        <label for="address" class="m-2 block text-sm font-medium text-gray-600">
                            Address.
                        </label>
                        <input type="text" placeholder="Enter address."
                            class="w-full rounded-md border-2 p-2 m-2 {{ $errors->has('address') ? 'border-red-500' : 'border-gray-300' }}"
                            name="address" id="address" wire:model='address'>
                        <span class="text-red-500 font-normal text-xs">{{ $errors->first('address') }}</span>
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:justify-between items-center md:space-x-10 p-1">
                    <div class="w-full">
                        <label for="comment" class="m-2 block text-sm font-medium text-gray-600">
                            Comment.
                        </label>
                        <textarea name="comment" id="comment" cols="30" rows="10"
                            class="w-full rounded-md border-gray-300 border-2 p-2 m-2" placeholder="Enter comment or specific instructions."
                            style="resize: none" wire:model='comment'></textarea>
                    </div>
                </div>

                <div class="flex flex-row space-x-1 mx-3 my-3">
                    <input type="checkbox" name="same" id="same" class="cursor-pointer"
                        wire:model='saveInfo' {{ $saveInfo ? 'checked' : '' }}>
                    <label for="same" class="text-sm font-semibold cursor-pointer">Save
                        info. for next time
                    </label>
                </div>

                <button class="rounded-md bg-orange-500 text-white p-2 m-2">Place Order</button>
            </form>
        </div>
        <div class="w-full md:w-1/4 p-4 flex flex-col">
            <div class="flex justify-center items-center mb-4">
                <p class="text-md font-bold">Order Summary</p>
            </div>
            <hr class="my-2">
            <div class="flex items-center justify-between m-2 my-4">
                <p class="text-sm font-normal">Sub Total</p>
                <p>Rs.{{ $subTotal }}</p>
            </div>
            <div class="flex items-center justify-between m-2 my-4">
                <p class="text-sm font-normal">Discount</p>
                <p>- Rs.{{ $discount }}</p>
            </div>
            <div class="flex items-center justify-between m-2 my-4">
                <p class="text-sm font-normal">Shipping</p>
                <p>Rs.250</p>
            </div>
            <hr class="mt-19 mt-20">
            <div class="flex items-center justify-between m-2 my-4 mb-4">
                <p class="text-md font-bold">Total</p>
                <p class="text-md font-bold">Rs.{{ $total }}</p>
            </div>
        </div>
    </div>
</div>

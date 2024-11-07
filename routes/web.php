<?php

use App\Livewire\Web\Auth\ResetPassword;
use App\Livewire\Web\Pages\About;
use App\Livewire\Web\Pages\Cart;
use App\Livewire\Web\Pages\Category;
use App\Livewire\Web\Pages\Checkout;
use App\Livewire\Web\Pages\Contact;
use App\Livewire\Web\Auth\ForgotPassword;
use App\Livewire\Web\Pages\Home;
use App\Livewire\Web\Pages\ProductDescription;
use App\Livewire\Web\Pages\Profile;
use App\Livewire\Web\Auth\Signin;
use App\Livewire\Web\Auth\Signup;
use App\Livewire\Web\Pages\Thankyou;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('login', Signin::class)->name('login');
Route::get('signup', Signup::class)->name('signup');
Route::get('forgot-password', ForgotPassword::class)->name('forgot-password');
Route::get('reset-password/{token}', ResetPassword::class)->name('password.reset');

Route::get('/', Home::class)->name('home');
Route::get('about-us', About::class)->name('about-us')->lazy();
Route::get('contact-us', Contact::class)->name('contact-us')->lazy();
Route::get('category/{cateslug}', Category::class)->name('category')->lazy();
Route::get('product-description/{cateslug}/{prodslug}', ProductDescription::class)->name('product-description');

Route::get('cart', Cart::class)->name('cart');
Route::get('thank-you', Thankyou::class)->name('thank-you');

Route::middleware('auth')->group(function () {
    Route::get('checkout', Checkout::class)->name('checkout');
    Route::get('Profile', Profile::class)->name('profile');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\ProductController;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProductController::class, 'index']);

Route::get('/login', function () {
    return view('login');
});

Route::get('/cartlist', function () {
    return view('cartlist');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/logout', function () {
    session()->forget('user');
    return redirect('login');
});

Route::post('/login', [userController::class, 'login']); //mentioning which class and function called
Route::post('/register', [userController::class, 'register']);
Route::post('/add_to_cart', [ProductController::class, 'addToCart']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('detail/{id}', [ProductController::class, 'detail']);
Route::post('/search', [ProductController::class, 'search']);
//Route::get('/cartlist', [ProductController::class, 'cartList']);
Route::get('/movetocart/{id}', [ProductController::class, 'moveToCart']);
Route::get('/checkout', [ProductController::class, 'checkOut']);
Route::post('/placeorder', [ProductController::class, 'placeOrder']);





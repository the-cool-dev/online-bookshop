<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return "default page";
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [userController::class, 'login']); //mentioning which class and function called
Route::get('/products', [ProductController::class, 'index']);


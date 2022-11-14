<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\ProductController;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;


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


Route::view('/', 'home');
Route::view('/login', 'login') -> name('login');
Route::view('/register', 'register');
Route::post('/register', [userController::class, 'register']);
Route::view('/about', 'about');
Route::post('/login', [userController::class, 'login']); //mentioning which class and function called
Route::get('/products', [ProductController::class, 'index']);

//To get detailed view of single product
Route::get('/detail/{id}', [ProductController::class, 'detail']) -> name('product_detail');

//To get a list of products
Route::get('product_list/{id}', [ProductController::class, 'productList']) -> name('product_list');

//To get a list of products by search keyword
Route::post('/search', [ProductController::class, 'search']);


Route::get('/forgot_password', function () {
    return view('forgot_password');
})->middleware('guest')->name('password.request');

Route::get('/confirm_password/{token}', function ($token) {
    return view('confirm_password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::get('/logout', function () {
    Auth::logout();
    session() -> flush();
    return redirect('/login');
});

//Reset Password Route with validation
Route::post('/forgot_password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');


//Actual resetting password Route
Route::post('/confirm_password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect('/login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');



// --------------------- MIDDLEWARE FOR USERS STARTS------------------------------------------------------------

Route::middleware(['auth', 'user'])->group(function () {


Route::view('/cartlist', 'cartlist');


Route::post('/add_to_cart', [ProductController::class, 'addToCart']);


//To move a product to cart
Route::get('/movetocart/{id}', [ProductController::class, 'moveToCart']);


//To display all products in carts in the checkout page
Route::get('/checkout', [ProductController::class, 'checkOut']);


//To move all the products from cart to order table
Route::post('/placeorder', [ProductController::class, 'placeOrder']);


});


// --------------------- MIDDLEWARE FOR USERS ENDS------------------------------------------------------------




// --------------------- MIDDLEWARE FOR ADMIN STARTS ---------------------------------------------------------


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
      return view('admin/admin_home');
    });

    Route::view('admin/edit_product', 'admin/edit_product');

    Route::view('admin/add_product', 'admin/add_product') -> name('admin/add_product');

    Route::get('admin/view_users', [userController::class, 'viewUsers']);
    
    Route::get('admin/view_orders', [ProductController::class, 'viewOrders']);
    
    Route::post('admin/view_order_details/{id}', [ProductController::class, 'viewOrderDetails']) -> name('view_order_details');
    
    Route::get('update_user_status/{id}/{status}', [userController::class, 'updateUserStatus']) -> name('update_user_status');

    Route::get('admin/view_products', [ProductController::class, 'viewProducts']) -> name('admin/view_products');

    Route::post('/delete_product', [ProductController::class, 'deleteProduct']);
    
    Route::get('edit_product/{id}', [ProductController::class, 'editProduct']) -> name('edit_product');
    
    Route::get('update_product_status/{id}/{status}', [ProductController::class, 'updateProductStatus']) -> name('update_product_status');
    
    Route::post('/update_product', [ProductController::class, 'updateProduct']);
    
    Route::post('/admin/add_product', [ProductController::class, 'addProduct']);



  });



//   --------------------- MIDDLEWARE FOR ADMIN ENDS --------------------------------------------------------


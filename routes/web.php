<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ajaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\user\UserController;

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

Route::middleware(['admin_auth'])->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class,'login'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'register'])->name('auth#registerPage');
    });
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

Route::middleware(['admin_auth'])->group(function () {

Route::prefix('category')->group(function () {
    Route::get('list',[CategoryController::class,'list'])->name('admin#list');
    Route::get('add',[CategoryController::class,'add'])->name('admin#addCategory');
    Route::post('create',[CategoryController::class,'create'])->name('admin#createCategory');
    Route::get('delete/{id}',[CategoryController::class,'delete'])->name('admin#deleteCategory');
    Route::get('edit/{id}',[CategoryController::class,'edit'])->name('admin#editCategory');
    Route::post('update/{id}',[CategoryController::class,'update'])->name('admin#updateCategory');
});
Route::prefix('profile')->group(function(){
    Route::get('change/passsword',[ProfileController::class,'changePassword'])->name('admin#changePassword');
    Route::post('update/password',[ProfileController::class,'updatePassword'])
    ->name('admin#updatePassword');
    Route::get('profile/detail',[ProfileController::class,'profile'])->name('admin#profile');
    Route::get('editprofile',[ProfileController::class,'editprofile'])->name('admin#editprofile');
    Route::post('updateprofile/{id}',[ProfileController::class,'updateProfile'])->name('admin#updateprofile');
});
Route::prefix('products')->group(function()
    {
        Route::get('list',[ProductController::class,'productList'])->name('admin#productList');
        Route::get('add',[ProductController::class,'addProduct'])->name('admin#addProduct');
        Route::post('add',[ProductController::class,'createProduct'])->name('admin#createProduct');
        Route::get('delete/{id}',[ProductController::class,'deleteProduct'])->name('admin#productDelete');
        Route::get('details/{id}',[ProductController::class,'detailProduct'])->name('admin#detailProduct');
        Route::get('edit/{id}',[ProductController::class,'editProduct'])->name('admin#editProduct');
        Route::post('update/{id}',[ProductController::class,'updateProduct'])->name('admin#updateProduct');
    });
    Route::prefix('adminUser')->group(function()
    {
        Route::get('adminlist',[AdminUserController::class,'adminList'])->name('admin#adminList');
        Route::get('userlist',[AdminUserController::class,'userList'])->name('admin#userList');

        Route::get('adminlistDelete/{id}',[AdminUserController::class,'adminListDelete'])->name('admin#adminListDelete');
        Route::get('changeRole/{id}',[AdminUserController::class,'ChangeRole'])->name('admin#changeRole');
        Route::post('changeRole/{id}',[AdminUserController::class,'updateRole'])->name('admin#updateRole');
    });
    Route::prefix('order')->middleware('admin_auth')->group(function()
    {
        Route::get('list',[OrderController::class,'orderList'])->name('admin#orderList');
        Route::get('list/{id}',[OrderController::class,'orderStatus'])->name('admin#orderStatus');
        Route::get('detail/{orderCode}',[OrderController::class,'orderDetail'])->name('admin#orderDetail');

    });
    Route::prefix('contact')->middleware('admin_auth')->group(function()
    {
        Route::get('list',[ContactController::class,'contactList'])->name('admin#contactList');
        // Route::get('list/{id}',[OrderController::class,'orderStatus'])->name('admin#orderStatus');
        Route::get('detail/{id}',[ContactController::class,'detail'])->name('admin#contactDetail');
        Route::get('delete/{id}',[ContactController::class,'delete'])->name('admin#contactDelete');
        Route::get('filter/{id}',[ContactController::class,'filter'])->name('admin#contactFilter');

    });
});
Route::prefix('user')->middleware('user_auth')->group(function () {
    Route::get('userHome',[UserController::class,'userHome'])->name('user#home');
    Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
    Route::get('profileDetail',[UserController::class,'profileDetail'])->name('user#profile');
    Route::get('pizza/detail/{id}',[UserController::class,'pizzaDetail'])->name('user#pizzaDetail');
    Route::get('passwordChange',[UserController::class,'passwordChange'])->name('user#password');
    Route::post('passwordChange',[UserController::class,'updatePassword'])->name('user#passwordChange');
    Route::get('updateProfile',[UserController::class,'editprofile'])->name('user#editProfile');
    Route::post('updateProfile/{id}',[UserController::class,'updateprofile'])->name('user#updateProfile');
    Route::get('cart',[UserController::class,'cart'])->name('user#cart');
    Route::get('history',[UserController::class,'history'])->name('user#history');
    Route::get('contact',[ContactController::class,'index'])->name('user#contact');
    Route::post('contact',[ContactController::class,'send'])->name('user#contactSend');
    Route::post('filter/price',[UserController::class,'filterByPrice'])->name('user#filterPrice');


    
    });
    Route::prefix('ajax')->group(function () {
        Route::get('pizza/list',[ajaxController::class,'order'])->name('ajax#order');
        Route::get('pizza/addCart',[ajaxController::class,'addCart'])->name('ajax#addCart');
        Route::get('pizza/deleteCart/{id}',[ajaxController::class,'deleteCart'])->name('ajax#deleteCart');
        Route::get('pizza/updateCart/{id}',[ajaxController::class,'updateCart'])->name('ajax#updateCart');
        Route::get('pizza/addOrder',[ajaxController::class,'addOrder'])->name('ajax#addOrder');
        Route::get('pizza/clear/cart',[ajaxController::class,'clearCart'])->name('ajax#clearCart');
        Route::get('status',[ajaxController::class,'status'])->name('ajax#status');
        Route::get('update/status',[ajaxController::class,'updateStatus'])->name('ajax#updateStatus');
        Route::get('view',[ajaxController::class,'view'])->name('ajax#view');
        Route::get('contact/view',[ajaxController::class,'contactView'])->name('ajax#contactView');



    });
    
});
<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProductsController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Mail\AuthenticationEmail;
use Illuminate\Support\Facades\Mail;

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
Route::get('/mails', function () {
    Mail::to("anhtienok0304@gmail.com")->send(new AuthenticationEmail());
});
Route::get('', [HomeController::class, 'index'])->name('/');
Route::get('/post', [PostController::class, 'index'])->name('post');
Route::get('/post/{id}', [PostController::class, 'detail'])->where(['id' => '[0-9]+']);
Route::get('/cat/{id}', [PostController::class, 'category'])->where(['id' => '[0-9]+']);
Route::get('/cart', [CartController::class, 'index']);

Route::get('/products', [ShopController::class, 'index']);
Route::get('/product/{id}', [ShopController::class, 'detail']);
Route::get('/products/category/{category_id}', [ShopController::class, 'category']);

// Authentication

Route::get('/login', [AuthenticationController::class, 'index'])->name('auth.index');
Route::post('/authenticate', [AuthenticationController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthenticationController::class, 'register'])->name('auth.register');
Route::post("/auth/logout", [AuthenticationController::class, 'logout'])->name('auth.logout');
Route::get("/auth/forgot", [AuthenticationController::class, 'forgotIndex'])->name('auth.forgot.index');
Route::post("/auth/forgot", [AuthenticationController::class, 'forgot'])->name('auth.forgot');
Route::get("/password/{id}/reset", [AuthenticationController::class, 'resetIndex'])->name('auth.reset.index')->where(['id' => '.{36}']);
Route::put("/password/reset", [AuthenticationController::class, 'reset'])->name('auth.reset');


//User
Route::middleware(['authUser'])->group(function () {
    Route::get('/user/changePassword', [AuthenticationController::class, 'change'])->name('auth.changePassword.index');
    Route::post('/user/change_password', [AuthenticationController::class, 'changePassword'])->name('auth.changePassword');
});

//Admin
Route::middleware(['authAdmin'])->group(function () {
    //
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.index');

    //CRUD Categories


    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/admin/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::post('/admin/categories/search', [CategoryController::class, 'search'])->name('categories.search');

    //CRUD Products

    Route::get('/admin/products', [AdminProductsController::class, 'index'])->name('products.index');
    Route::get('/admin/products/create', [AdminProductsController::class, 'create'])->name('products.create');
    Route::post('/admin/products', [AdminProductsController::class, 'store'])->name('products.store');
    Route::get('/admin/products/{id}', [AdminProductsController::class, 'show'])->name('products.show');
    Route::get('/admin/products/{id}/edit', [AdminProductsController::class, 'edit'])->name('products.edit');
    Route::put('/admin/products/{id}', [AdminProductsController::class, 'update'])->name('products.update');
    Route::delete('/admin/products/{id}', [AdminProductsController::class, 'destroy'])->name('products.destroy');
    Route::post('/admin/products/search', [AdminProductsController::class, 'search'])->name('products.search');
});
<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Frontend Controller
Route::get('/', [FrontendController::class, 'home'])->name('site');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// User Controller
Route::get('/user/list', [UserController::class, 'users'])->name('users');
Route::get('/user/delete/{user_id}', [UserController::class, 'user_delete'])->name('user.delete');

// Profile(User)
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/profile/name/update', [UserController::class, 'profile_name_update'])->name('name.update');
Route::post('/profile/password/update', [UserController::class, 'profile_password_update'])->name('password.update');
Route::post('/profile/image/update', [UserController::class, 'profile_image_update'])->name('image.update');

// Category
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/category/add', [CategoryController::class, 'add_category'])->name('add.category');
Route::get('/category/soft/delete/{category_id}', [CategoryController::class, 'category_soft_delete'])->name('category.delete');
Route::get('/category/force/delete/{category_id}', [CategoryController::class, 'category_force_delete'])->name('category.force.delete');
Route::get('/category/edit/{category_id}', [CategoryController::class, 'category_edit'])->name('category.edit');
Route::post('/category/update', [CategoryController::class, 'category_update'])->name('category.update');

// Subcategory
Route::get('/subcategory', [SubcategoryController::class, 'subcategory'])->name('subcategory');
Route::post('/subcategory/add', [SubcategoryController::class, 'add_subcategory'])->name('add.subcategory');
Route::get('/subcategory/soft/delete/{subcategory_id}', [SubcategoryController::class, 'subcategory_soft_delete'])->name('subcategory.delete');
Route::get('/subcategory/restore/{subcategory_id}', [SubcategoryController::class, 'subcategory_restore'])->name('subcategory.restore');
Route::get('/subcategory/edit/{subcategory_id}', [SubcategoryController::class, 'subcategory_edit'])->name('subcategory.edit');
Route::get('/subcategory/force/delete/{subcategory_id}', [SubcategoryController::class, 'subcategory_force_delete'])->name('subcategory.force.delete');
Route::post('/subcategory/update/', [SubcategoryController::class, 'subcategory_update'])->name('update.subcategory');

// Product
Route::get('/product', [ProductController::class, 'product'])->name('product');
Route::post('/getSubcategory', [ProductController::class, 'getSubcategory']);
Route::post('/product/store', [ProductController::class, 'product_store'])->name('product.store');
Route::get('/product/list', [ProductController::class, 'product_list'])->name('product.list');
Route::get('/product/delete/{product_id}', [ProductController::class, 'product_delete'])->name('product.delete');

// Product Inventory
Route::get('/product/inventory/{product_id}', [ProductController::class, 'inventory'])->name('inventory');
Route::post('/product/inventory/store', [ProductController::class, 'inventory_store'])->name('inventory.store');
Route::get('/product/inventory/delete/{product_id}', [ProductController::class, 'inventory_delete'])->name('inventory.delete');


// Product Variation
Route::get('/product/variation', [ProductController::class, 'product_variation'])->name('product.variation');
Route::post('/product/variation/color', [ProductController::class, 'add_color'])->name('add.color');
Route::post('/product/variation/size', [ProductController::class, 'add_size'])->name('add.size');
Route::get('/product/variation/color/delete/{color_id}', [ProductController::class, 'color_delete'])->name('color.delete');
Route::get('/product/variation/size/delete/{size_id}', [ProductController::class, 'size_delete'])->name('size.delete');
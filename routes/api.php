<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackOffice\POSController;
use App\Http\Controllers\BackOffice\CategoryController;
use App\Http\Controllers\BackOffice\CartController;
use App\Http\Controllers\FrontEnd\CatalogController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Auth\ClientLoginController;
use App\Http\Controllers\BackOffice\ProductController;
use App\Http\Controllers\BackOffice\SubscriptionController;
use App\Http\Controllers\ContactController;
use App\Models\Brand;


Route::get('/pos/products', POSController::class);
Route::get('/pos/categories', CategoryController::class);
// Route::get('/cart-items', CartController::class);
Route::get('wabegadgets/products', [CatalogController::class, 'vueindex']);

Route::get('wabegadgets/categories', [CatalogController::class, 'vuecategory']);

Route::get('/check-authentication', [ClientLoginController::class, 'checkAuthentication']);

Route::get('categories', [CategoryController::class, 'index']);
Route::get('/blogs/related/{id}', [BlogController::class, 'getRelatedBlogs']);
Route::get('/blogs/latest', [BlogController::class, 'getLatestBlogs']);
Route::get('/search-products', [ProductController::class, 'search']);
Route::get('/category/{slug}/products', [ProductController::class, 'getCategoryProducts']);
Route::post('/subscribe', [SubscriptionController::class, 'store']);
Route::get('/trending-products', [ProductController::class, 'getTrendingProducts']);
Route::post('/contact', [ContactController::class, 'store']);
Route::get('/brands', function () {
    return Brand::all();
});








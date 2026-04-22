<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/tes', function(){
    return 'tes';
});

// Route::get('/dashboard', function(){
//     return view('admin.dashboard.index');
// })->name('dashboard');

// Route::post('product/{slug}/edit', [ProductController::class, 'update'])->name('product.update-new');
// Route::get('product/ajax-table', [ProductController::class, 'tableProduct'] )->name('product.ajax');
// Route::resource('product', ProductController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route Halaman Admin
Route::group([], __DIR__.'/admin.php');

// route untuk tools (clear cache, clear config, clear view, etc)
Route::group([], __DIR__.'/tools.php');
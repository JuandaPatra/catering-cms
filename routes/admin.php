<?php
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\InvoiceController;
// use Symfony\Component\Routing\Route;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
     Route::group(['middleware' => ['role:super-admin|admin']], function () {
        Route::get('/admin-dashboard', function(){
            return view('admin.dashboard.index');
        })->name('admin.dashboard');

        // Route untuk manajemen user, hanya bisa diakses oleh super-admin
        Route::group(['middleware' => ['role:super admin']], function () {

        });
        

        // Route untuk manajemen produk, bisa diakses oleh super-admin dan admin
        Route::group(['middleware' => ['role:super-admin|admin']], function () {
        Route::post('product/{slug}/edit', [ProductController::class, 'update'])->name('product.update-new');
        Route::get('product/ajax-table', [ProductController::class, 'tableProduct'] )->name('product.ajax');
        Route::resource('product', ProductController::class);

        Route::get('invoice/ajax-table', [InvoiceController::class, 'tableInvoice'])->name('invoice.ajax');
        Route::post('invoice/preview-pdf', [InvoiceController::class,'previewPDF'])->name('invoice.preview');
        Route::get('invoice/download/{id}', [InvoiceController::class, 'downloadPDF'])->name('invoice.download');


        Route::resource('invoice', InvoiceController::class);

        Route::get('roles/ajax', [App\Http\Controllers\Admin\RoleController::class, 'ajax'])->name('roles.ajax');
        Route::resource('roles', App\Http\Controllers\Admin\RoleController::class)->middleware('permission:create role|edit role|delete role');
        
        Route::get('users/ajax', [App\Http\Controllers\Admin\UserController::class, 'ajax'])->name('users.ajax');
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);});
            
        // ajax tools
        Route::get('tools/ajax-roles', [App\Http\Controllers\Admin\AjaxToolsController::class, 'ajaxRoles'])->name('tools.ajax.roles');
    
        // settings
        Route::get('settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->middleware('permission:edit settings')->name('settings.index');
        Route::post('settings', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->middleware('permission:edit settings')->name('settings.update');
    });
});
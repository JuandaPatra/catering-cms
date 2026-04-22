<?php

use App\Events\MessageCreated;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Tools Routes
|--------------------------------------------------------------------------
|
| Here is where you can register tools routes for your application. 
|
*/

Route::get('coba-tools', function(){
    return 'coba tools';
});


Route::get('email-test', function () {
    $details['email'] = 'patrajuanda10@gmail.com';
    dispatch(new App\Jobs\SendEmailJob($details));
    dd('done');
});

Route::get('/push', function(){
    // MessageCreated::dispatch('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, ipsam.');
    // MessageCreated::dispatch('Lorem');
    // event(new MessageCreated());
    // dd('done');
    return view('web.login.index');
});

Route::get('/ges', function(){
    $data['tes'] = '33087512525613';
    event(new MessageCreated($data[
        'tes'
    ]));

});




Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
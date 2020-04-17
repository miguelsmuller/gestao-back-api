<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', 'Web\HomeController@welcome')->name('home.welcome');

Route::get('/phpinfo', function (Request $request) {
    phpinfo();
})->name('home.phpinfo');

Route::get('{query}', function (Request $request) {
    return redirect()->route('home.welcome');
})->name('home.redirect');

/* Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/oauth',
        'Web\Base\HomeController@oauth')->name('oauth');
});
 */

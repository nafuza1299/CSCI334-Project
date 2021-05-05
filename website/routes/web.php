<?php

use Illuminate\Support\Facades\Route;
use App\Notifications\Alerts;
use App\Models\User;

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
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//user
Route::get('/', function () {
    return view('user.home');
})->name('home');


Route::get('quick-check-in',  function()
{
    return view('quick-check-in');
})->name('quick-check-in');

Route::get('overview', ['middleware' => 'auth', 'uses' => 'OverviewController@index'])->name('overview');

Route::get('vaccine', ['middleware' => 'auth', function()
{
    return view('user.vaccine');
}])->name('vaccine');

Route::get('profile', ['middleware' => 'auth', 'uses' => 'ProfileController@index'])->name('profile');

Route::get('alerts', ['middleware' => 'auth', 'uses' => 'AlertsController@index'])->name('alerts');

Route::get('history', ['middleware' => 'auth', 'uses' => 'CheckInController@index'])->name('history');

Route::get('/qr-code/check-in/{latitude}/{longitude}/{address}', 'QRCodeController@index')->name("qr-check-in");

Route::post('/qr-code/success', ['middleware' => 'guest', 'uses' => 'QrCodeController@store'])->name('qr-login');

Route::get('news', ['uses' => 'NewsController@index'])->name('news');

Route::get('/message', ['middleware' => 'auth', 'uses' => 'AlertsController@createAlert'])->name('createAlert');

//business
Route::prefix('business')->group(function () {
    Route::get('/', function () {
        return view('organization.home');
    })->name('business');
    Route::get('/profile', ['uses' => 'ProfileController@business'])->name('business.profile');

    Route::get('/news', ['uses' => 'NewsController@index'])->name('business.news');

    Route::get('/alerts', ['uses' => 'AlertsController@index'])->name('business.alerts');

    Route::get('/overview', [ 'uses' => 'OverviewController@business'])->name('business.overview');
});
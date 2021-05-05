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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('quick-check-in',  function()
{
    return view('quick-check-in');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


//user
Route::get('/overview', ['middleware' => 'auth', 'uses' => 'OverviewController@index']);

Route::get('vaccine', ['middleware' => 'auth', function()
{
    return view('user.vaccine');
}]);

Route::get('profile', ['middleware' => 'auth', 'uses' => 'ProfileController@index'])->name('profile');

Route::get('alerts', ['middleware' => 'auth', 'uses' => 'AlertsController@index'])->name('alerts');

Route::get('history', ['middleware' => 'auth', 'uses' => 'CheckInController@index'])->name('history');

Route::get('/qr-code/generate/{latitude}/{longitude}/{address}', 'QRCodeController@index');

Route::post('/qr-code/success', ['middleware' => 'guest', 'uses' => 'QrCodeController@store'])->name('qr-login');

Route::get('news', ['uses' => 'NewsController@index'])->name('news');

Route::get('/message', ['middleware' => 'auth', 'uses' => 'AlertsController@createAlert'])->name('createAlert');
<?php

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

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//template
Route::get('/pricing', function () {
    return view('template.pricing');
});

Route::get('/contact', function () {
    return view('template.contact');
});

Route::get('/services', function () {
    return view('template.services');
});

Route::get('/about', function () {
    return view('template.about');
});

Route::get('/counselor', function () {
    return view('template.counselor');
});

Route::get('/blog', function () {
    return view('template.blog');
});

Route::get('/blog-single', function () {
    return view('template.blog-single');
});

//public
Route::get('/overview', ['middleware' => 'auth', 'uses' => 'OverviewController@index']);

Route::get('vaccine', ['middleware' => 'auth', function()
{
    return view('vaccine');
}]);

Route::get('quick-check-in', ['middleware' => 'auth', function()
{
    return view('quick-check-in');
}]);

Route::get('alerts', ['middleware' => 'auth', function()
{
    return view('alerts');
}]);

Route::get('history', ['middleware' => 'auth', function()
{
    return view('history');
}]);

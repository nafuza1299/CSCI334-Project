<?php

use Illuminate\Support\Facades\Route;
use App\Notifications\Alerts;
use App\Models\User;
use App\Http\Controllers\FileDownloadControllers\UserFileDownloadController;
use App\Http\Controllers\FileDownloadControllers\BusinessFileDownloadController;

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

Route::get('/location',  [ 'uses' => 'SearchInfectLocationController@index'])->name('location');

Route::get('overview', ['middleware' => 'auth', 'uses' => 'OverviewController@index'])->name('overview');

Route::get('vaccine', ['middleware' => 'auth', function()
{
    return view('user.vaccine');
}])->name('vaccine');

Route::get('/report/staff', ['middleware' => ['auth', 'checkifhealthstaff'], 'uses' => 'ReportsController@staff'])->name('staff.report');

Route::get('/statistics', ['middleware' => 'auth', 'uses' => 'ReportsController@public'])->name('statistics');

Route::get('/vaccine/certificate',  ['middleware' => 'auth', 'uses' => 'VaccineCertificateController@index'])
                    ->name('vaccine.certificate');

Route::post('/vaccine/upload-vaccine-certificate',  ['middleware' => 'auth', 'uses' => 'VaccineCertificateController@store'])
                    ->name('upload.vaccine.certificate');

Route::get('profile', ['middleware' => 'auth', 'uses' => 'ProfileController@index'])->name('profile');

Route::get('alerts', ['middleware' => 'auth', 'uses' => 'AlertsController@index'])->name('alerts');

Route::get('history', ['middleware' => 'auth', 'uses' => 'CheckInController@index'])->name('history');

Route::get('test-results', ['middleware' => 'auth', 'uses' => 'TestResultController@index'])->name('test.results');

Route::get('/qr-code/check-in/{id}', 'QRCodeController@index')->name("qr-check-in");

Route::post('/qr-code/success', ['middleware' => 'guest', 'uses' => 'QRCodeController@store'])->name('qr-login');

Route::get('news', ['uses' => 'NewsController@index'])->name('news');

Route::get('/message', ['middleware' => 'auth', 'uses' => 'AlertsController@createAlert'])->name('createAlert');

// route for editing profile
Route::post('/edit-profile',['middleware' => 'auth', 'uses' => 'ProfileController@editAccountInfo'])
                ->name('edit.profile');

Route::get('test-resulted', ['middleware' => 'auth', 'uses' => 'TestResultController@infectalert'])->name('test.resulted');

//business
Route::prefix('organization')->group(function () {
    Route::get('/', function () {
        return view('organization.home');
    })->name('business');

    Route::get('/location',  [ 'uses' => 'SearchInfectLocationController@index'])->name('business.location');

    Route::get('/news', ['uses' => 'NewsController@index'])->name('business.news');

    Route::get('/profile', ['middleware' => 'business.auth:business','uses' => 'ProfileController@business'])->name('business.profile');

    Route::get('/alerts', ['middleware' => 'business.auth:business', 'uses' => 'AlertsController@business'])->name('business.alerts');

    Route::post('/alerts/create', ['middleware' => ['business.auth:business', 'checkifhealthorg:business'], 'uses' => 'AlertsController@createAlert'])->name('business.create.alerts');

    Route::get('/overview', ['middleware' => 'business.auth:business', 'uses' => 'OverviewController@business'])->name('business.overview');

    Route::get('/message', ['middleware' => 'business.auth:business','uses' => 'AlertsController@createAlertBusiness'])->name('createAlertBusiness');

    Route::get('/generate-qr-code', ['middleware' => 'business.auth:business','uses' => 'QRCodeController@indexGenerate'])->name('business.generate.qr');
    
    Route::get('/safe-registration', ['middleware' => ['business.auth:business', 'checkifgeneral:business'], 'uses' => 'SafeRegistrationController@index'])->name('business.safe.registration');

    Route::get('/safe-registration/download', [BusinessFileDownloadController::class, 'self_download_certs'])->name('saferegistration.download');

    Route::get('/report/business', ['middleware' => ['business.auth:business', 'checkifgeneral:business'], 'uses' => 'ReportsController@business'])->name('business.report');

    Route::get('/report/health', ['middleware' => ['business.auth:business', 'checkifhealthorg:business'], 'uses' => 'ReportsController@healthorg'])->name('health.report');

    Route::post('/edit-profile', ['middleware' => 'business.auth:business','uses' => 'ProfileController@editAccountInfoBusiness'])
                    ->name('business.edit.profile');

    Route::post('/edit-address', ['middleware' => 'business.auth:business','uses' => 'ProfileController@editAddressInfoBusiness'])
                    ->name('business.edit.address');

    Route::post('/insert-address',  ['middleware' => 'business.auth:business','uses' => 'ProfileController@storeAddressInfoBusiness'])
                    ->name('business.insert.address');

    Route::post('/delete-address', ['middleware' => 'business.auth:business', 'uses' => 'ProfileController@deleteAddressInfoBusiness'])
                    ->name('business.delete.address');

    Route::post('/generated-qr-code',  ['middleware' => 'business.auth:business', 'uses' => 'QRCodeController@generateQR'])
                    ->name('generate.qr.code');

    Route::post('/upload-business-certificate',  ['middleware' => 'business.auth:business', 'uses' => 'SafeRegistrationController@store'])
                    ->name('business.upload.certificate');
    
    Route::get('/health-statistics', ['middleware' => ['business.auth:business', 'checkifhealthorg:business'], 'uses' => 'HealthStatisticsController@index'])->name('business.healthorg.statistics');
    Route::post('/health-statistics', ['middleware' => ['business.auth:business', 'checkifhealthorg:business'], 'uses' => 'HealthStatisticsController@store']);
});

// routes to download files
Route::get('staff/user/certs/{file_name}', [UserFileDownloadController::class, 'admin_download_certs']);
Route::get('staff/business/certs/{file_name}', [BusinessFileDownloadController::class, 'download_certs']);
Route::get('/vaccine/download', [UserFileDownloadController::class, 'self_download_certs'])->name('vaccine.download');

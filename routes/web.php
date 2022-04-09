<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VillaController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ApprovedBankController;
use App\Http\Controllers\HomepageBannerController;
use App\Http\Controllers\HomepageSettingController;
use App\Http\Controllers\BrochureRequestController;

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
    return redirect()->route('login');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return redirect('/homepage-settings/1/edit');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('users', UserController::class);
        Route::resource('homepage-settings', HomepageSettingController::class);
        Route::resource('villas', VillaController::class);
        Route::resource('images', ImageController::class);
        Route::resource('brochure-requests', BrochureRequestController::class);
        Route::resource('homepage-banners', HomepageBannerController::class);
        Route::resource('approved-banks', ApprovedBankController::class);
    });

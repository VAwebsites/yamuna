<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\VillaController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\VillaImageController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ApprovedBankController;
use App\Http\Controllers\Api\HomepageBannerController;
use App\Http\Controllers\Api\HomepageSettingController;
use App\Http\Controllers\Api\BrochureRequestController;
use App\Http\Controllers\Api\VillaVillaImagesController;
use App\Http\Controllers\Api\HomepageSettingApprovedBanksController;
use App\Http\Controllers\Api\HomepageSettingHomepageBannersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('api.')->group(function () {
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);

    Route::apiResource('users', UserController::class);

    Route::apiResource('homepage-settings', HomepageSettingController::class);

    // HomepageSetting Approved Banks
    Route::get('/homepage-settings/{homepageSetting}/approved-banks', [
        HomepageSettingApprovedBanksController::class,
        'index',
    ])->name('homepage-settings.approved-banks.index');
    Route::post('/homepage-settings/{homepageSetting}/approved-banks', [
        HomepageSettingApprovedBanksController::class,
        'store',
    ])->name('homepage-settings.approved-banks.store');

    // HomepageSetting Homepage Banners
    Route::get('/homepage-settings/{homepageSetting}/homepage-banners', [
        HomepageSettingHomepageBannersController::class,
        'index',
    ])->name('homepage-settings.homepage-banners.index');
    Route::post('/homepage-settings/{homepageSetting}/homepage-banners', [
        HomepageSettingHomepageBannersController::class,
        'store',
    ])->name('homepage-settings.homepage-banners.store');

    Route::apiResource('villas', VillaController::class);

    // Villa Villa Images
    Route::get('/villas/{villa}/villa-images', [
        VillaVillaImagesController::class,
        'index',
    ])->name('villas.villa-images.index');
    Route::post('/villas/{villa}/villa-images', [
        VillaVillaImagesController::class,
        'store',
    ])->name('villas.villa-images.store');

    Route::apiResource('images', ImageController::class);

    Route::apiResource('brochure-requests', BrochureRequestController::class);
});

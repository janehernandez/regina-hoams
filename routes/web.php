<?php

use App\Http\Controllers\Admin\AdminListController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Admin\ChangeMemberStatusController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeownerController;
use App\Http\Controllers\Admin\OfficerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Homeowner;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::match(['POST', 'GET'], '/admin/', function () {
    return redirect('/admin/login');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'guest'], function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('login', AuthLoginController::class)->only(['index', 'store']);
    });

    Route::prefix('login')->name('login.')->group(function () {
        Route::resource('/', LoginController::class)->only(['index', 'store']);
    });

    Route::prefix('register')->name('register.')->group(function () {
        Route::post('/', [RegisterController::class, 'store'])->name('store');
        Route::get('/', [RegisterController::class, 'index'])->name('index');
    });
});

Route::prefix('admin')->name('admin.')->middleware('auth', Admin::class)->group(function () {
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('officers', OfficerController::class);
    Route::get('homeowners', HomeownerController::class)->name('homeowners');
    Route::put('/{user}/update-cod', ChangeMemberStatusController::class)->name('homeowners.update.member.status');

    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::get('admins', AdminListController::class)->name('admins');
});

Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('form', [FormController::class, 'index'])->name('form');

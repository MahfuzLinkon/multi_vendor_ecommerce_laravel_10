<?php

use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



// Admin All Route
Route::prefix('/admin')->namespace('App\Http\Controller\Admin')->group(function (){
    // Auth
    Route::get('/login', [SessionController::class, 'index'])->middleware('guest');
    Route::post('/login-check', [SessionController::class, 'loginCheck'])->name('login-check');
    Route::post('/login', [SessionController::class, 'store']);
    // Admin middleware group
    Route::group(['middleware' => ['admin']], function() {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [SessionController::class, 'destroy']);
        // Setting
        Route::get('/password-update', [PasswordController::class, 'create']);
        Route::post('/admin-password-check', [PasswordController::class, 'passwordCheck'])->name('admin.password-check');
        Route::post('/password-update', [PasswordController::class, 'store']);
        // Update profile
        Route::get('/profile-edit', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('admin.profile-edit');
        Route::post('/profile-update', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile-update');

    });
});



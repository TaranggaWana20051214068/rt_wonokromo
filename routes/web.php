<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use App\Models\Asset;
use App\Models\Penduduk;
use App\Models\posyandu;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostyanduController;
use App\Providers\RouteServiceProvider;

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
    return view('auth.login');
})->middleware('guest');

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    if (Auth::viaRemember()) {
        return redirect()->intended(RouteServiceProvider::HOME);
    }
    return view('auth.login');
});

Route::get('/dashboard', function () {
    $pendudukCount = Penduduk::count();
    $posyanduCount = posyandu::count();
    $assetCount = Asset::count();
    $data = [
        'pendudukCount' => $pendudukCount,
        'posyanduCount' => $posyanduCount,
        'inventoryCount' => $assetCount,
    ];
    return view('dashboard', compact('data'));
    ;
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // users
    Route::resource('/users', UserController::class);
    Route::delete('/users', [UserController::class, 'destroy'])->name('users.destroy');

    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // assets
    Route::resource('/assets', AssetController::class);
    Route::delete('/assets', [AssetController::class, 'destroy'])->name('assets.destroy');

    // posyandu
    Route::resource('/posyandu', PostyanduController::class);
    Route::delete('/posyandu', [PostyanduController::class, 'destroy'])->name('posyandu.destroy');

    // penduduk
    Route::resource('/penduduk', PendudukController::class);
    Route::delete('/penduduk', [PendudukController::class, 'destroy'])->name('penduduk.destroy');

    // category
    Route::resource('/category', CategoryController::class);
    Route::delete('/category', [CategoryController::class, 'destroy'])->name('category.destroy');

});

require __DIR__ . '/auth.php';

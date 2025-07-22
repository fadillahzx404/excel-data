<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\UsersController;
use App\Models\ColoringDataCol;

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
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $coloringDataCol = ColoringDataCol::all();
        return view('dashboard', ['coloringDataCol' => $coloringDataCol]);
    })->name('dashboard');
    Route::get('/datas/check', [DataController::class, 'check'])->name('datas-check');
    Route::post('/datas/update-col', [DataController::class, 'update_col'])->name('datas-update-col');
    Route::post('/datas/update-row', [DataController::class, 'update_row'])->name('datas-update-row');
    Route::delete('/datas/delete-col', [DataController::class, 'destroy_col'])->name('datas-delete-col');
    Route::delete('/datas/delete-row', [DataController::class, 'destroy_row'])->name('datas-delete-row');
    Route::resource('category', CategoryController::class);
    Route::resource('datas', DataController::class);
    Route::resource('user-settings', UsersController::class);
});

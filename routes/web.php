<?php

use App\Http\Controllers\MasterController;
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

Route::redirect('/', '/login');

Route::get('/dashboard', [MasterController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Master
    Route::get('/datatables', [MasterController::class, 'datatables'])->name('master.datatables');
    Route::get('/master', [MasterController::class, 'index'])->name('master.index');
    Route::post('/master/store', [MasterController::class, 'store'])->name('master.store');
    Route::get('/master/create', [MasterController::class, 'create'])->name('master.create');
    Route::get('/master/show/{id}', [MasterController::class, 'show'])->name('master.show');
    Route::get('/master/edit/{id}', [MasterController::class, 'edit'])->name('master.edit');
    Route::put('/master/update/{id}', [MasterController::class, 'update'])->name('master.update');
    Route::get('/master/destroy/{id}', [MasterController::class, 'destroy'])->name('master.destroy');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

<?php

use App\Models\User;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});
Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');


    /* Route::get('/dashboard', function () {
        $users = User::all();
    return view('admin.dashboard',compact('users'));
    })->middleware(['verified'])->name('dashboard'); */
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

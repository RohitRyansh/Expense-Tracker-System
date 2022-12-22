<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (Auth::check()) {
         
        return to_route ('dashboard');
    }

    return to_route ('login');
});

Route::controller(LoginController::class)->group(function () {

    Route::get('/login', 'index')->name('login');
    
    Route::post('/login', 'userAuthentication')->name('users.authentication');
    
})->middleware('guest');

Route::get ('/dashboard', [UserController::class, 'index'])->name('dashboard');

Route::get ('/logout', [LoginController::class, 'logout'])->name('logout');

Route::controller(CategoryController::class)->group(function () {

    Route::get ('/categories/{month}/month', 'index')->name ('categories.month');
    
    Route::get ('/categories/create', 'create')->name ('categories.create');
    
    Route::post ('/categories/store/{month}', 'store')->name ('categories.store');
    
    Route::get ('/categories/{category:slug}/edit', 'edit')->name ('categories.edit');
    
    Route::post ('/categories/{category:slug}/update', 'update')->name ('categories.update');
    
});

Route::get ('/categories/{category:slug}/expenses', [ExpenseController::class, 'index'])->name ('categories.month.expenses');

Route::get ('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');

Route::post ('/expenses/store', [ExpenseController::class, 'store'])->name('expenses.store');

// Route::get ('/month', [UserController::class, 'index'])->name('dashboard');

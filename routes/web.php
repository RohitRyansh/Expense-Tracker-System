<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpensesListingController;
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

Route::middleware('auth')->group(function () {
    
    Route::get ('/dashboard', [UserController::class, 'index'])->name('dashboard');
    
    Route::get ('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::controller(CategoryController::class)->group(function () {
         
        Route::get ('/categories/{month:slug}/month', 'index')->name ('categories.month');
        
        Route::get ('/categories/create', 'create')->name ('categories.create');
        
        Route::post ('/categories/store', 'store')->name ('categories.store');
        
        Route::get ('/categories/{month:slug}/{category:slug}/edit', 'edit')->name ('categories.edit');
        
        Route::post ('/categories/{month:slug}/{category:slug}/update', 'update')->name ('categories.update');
    
    });

    Route::controller(ExpenseController::class)->group(function () {
        
        Route::get ('/categories/{month:slug}/{category:slug}/expenses', 'index')->name ('categories.month.expenses');
        
        Route::get ('/expenses/create', 'create')->name('expenses.create');
        
        Route::post ('/expenses/store', 'store')->name('expenses.store');

        Route::get ('/expenses/{month:slug}/{category:slug}/{expense:slug}/edit', 'edit')->name ('expenses.edit');
        
        Route::post ('/expenses/{month:slug}/{category:slug}/{expense:slug}/update', 'update')->name ('expenses.update');
    
    });

    Route::get ('/expenses/view', [ExpensesListingController::class, 'index'])->name('expenses.listing');

    Route::post ('/expenses/view', [ExpensesListingController::class, 'filterByDate'])->name('expenses.listingByDate');
});



<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;



// Route::get('dash',function(){return view('dashboard');}); // logout

// Resourses For Dashboard


Route::group([
    'middleware' => ['auth:admin'] ,
    'as' => 'dashboard.',  // as Because the route in the link or form post you now that is includes for dashboard route
    'prefix' => 'admin/dashboard'
],function () {
    Route::get('profile',[ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile',[ProfileController::class, 'update'])->name('profile.update');


    Route::get('', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('categories/{category}/restore',[CategoryController::class,'restore'])->name('categories.restore');
    Route::delete('categories/{category}/force-delete',[CategoryController::class, 'forceDelete'])->name('categories.force-delete');

    Route::get('categories/trash',[CategoryController::class, 'trash'])->name('categories.trash');
    Route::resource('/categories' , CategoryController::class);
    Route::resource('/products' , ProductController::class);


});
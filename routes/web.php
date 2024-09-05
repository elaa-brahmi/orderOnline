<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\foodController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/foods/{category}', [foodController::class, 'showbycategory'])->name('food.category');



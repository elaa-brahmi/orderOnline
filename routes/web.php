<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\foodController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\orderController;



Route::get('/dashboard', function () {
    return view('dashboard');
})->name("backtodashboard");
Route::get('/foods/{category}', [foodController::class, 'showbycategory'])->name('food.category');
Route::get('/foods/{food_id}', [foodController::class, 'showbyid'])->name('food.id');
Route::get('/authentification',function(){
    return view("authentification");
})->name("authentification");
Route::post('/dashboard',[adminController::class,'authen'])->name("auth");
Route::get('/dashboard/checkOrder',function(){
    return view("order");
})->name('checkOrder');
Route::post('/dashboard/checkOrder',[orderController::class,'order'])->name("confirmOrder");





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

Route::post('/espaceAdmin',[adminController::class,'authen'])->name("espaceAdmin");

Route::get('/dashboard/checkOrder',function(){
    return view("order");

})->name('checkOrder');
Route::post('/dashboard/checkOrder',[orderController::class,'order'])->name("confirmOrder");

Route::get('/espaceAdmin',function(){
    return view("espaceAdmin");
})->name("admin.dashboard");

Route::get('/espaceAdmin',[adminController::class,'display_food'])->name("displayFood");
Route::get('/espaceAdmin/addfood',function(){
    return view('addfood');
})->name("addfood");

Route::post('espaceAdmin/addfood',[adminController::class,'save_food'])->name("savefood");

Route::get('/espaceAdmin/data',[adminController::class,'display_food'])->name("displayFood");

Route::get('/espaceAdmin',function(){
    return view('espaceAdmin');
})->name("foodadded");

Route::get('/espaceAdmin/update/{id}',function($id){
    return view('updateFood',['id'=>$id]);
})->name("update");

Route::post('/espaceAdmin/delete/{id}',[adminController::class,'delete'])->name('deletefood');

Route::get('/espaceAdmin/getfood/{id}',[adminController::class,'getfood'])->name('getfood');

Route::post('/espaceAdmin/update',[adminController::class,'update'])->name('updatefood');


Route::get('/espaceAdmin/orders',function(){
    return view('ordersList');
})->name("vieworders");


Route::get('/espaceAdmin/getOrders',[adminController::class,'orders'])->name('getOrders');






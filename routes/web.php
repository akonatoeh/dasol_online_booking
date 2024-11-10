<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\HomeController;



Route::get('/', [AdminController::class, 'home']);

route::get('/home', [AdminController::class, 'index'])->name('home');

Route::get('about', [AdminController::class, 'about']);

route::get('/admin_home', [AdminController::class, 'admin_home'])->name('home');

route::get('/superadmin_home', [AdminController::class, 'superadmin_home'])->name('home');

route::get('/create_room', [AdminController::class,'create_room']);

route::post('/add_room', [AdminController::class,'add_room']);

route::post('/add_tours_activities', [AdminController::class,'add_tours_activities']);

route::get('/view_room', [AdminController::class,'view_room']);

route::get('/view_tours', [AdminController::class,'view_tours']);

route::get('/view_activities', [AdminController::class,'view_activities']);


route::get('/create_tours_activities', [AdminController::class,'create_tours_activities']);

route::get('/add_user', [AdminController::class,'add_user']);

route::get('/view_account', [AdminController::class,'view_account']);

Route::post('/add.user', [UserController::class, 'store'])->name('add.user'); 

Route::middleware('auth')->group(function () {
    Route::get('view_room', [AdminController::class, 'view_room']);
});
Route::middleware('auth')->group(function () {
    Route::get('view_activities', [AdminController::class, 'view_activities']);
});
Route::middleware('auth')->group(function () {
    Route::get('view_tours', [AdminController::class, 'view_tours']);
});

route::get('/room_delete/{id}', [AdminController::class,'room_delete']);
route::get('/activity_delete/{id}', [AdminController::class,'activity_delete']);
route::get('/tour_delete/{id}', [AdminController::class,'tour_delete']);



route::get('/update_room/{id}', [AdminController::class,'update_room']);
route::get('/update_activities/{id}', [AdminController::class,'update_activities']);
route::get('/update_tours/{id}', [AdminController::class,'update_tours']);


route::post('/edit_room/{id}', [AdminController::class,'edit_room']);
route::post('/edit_tour/{id}', [AdminController::class,'edit_tour']);
route::post('/edit_activity/{id}', [AdminController::class,'edit_activity']);

route::get('/room_details/{id}', [HomeController::class,'room_details']);











<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\BookingController;



Route::get('/', [AdminController::class, 'home']);

route::get('/home', [AdminController::class, 'index'])->name('home');

Route::get('about', [AdminController::class, 'about']);

Route::get('room_page', [AdminController::class, 'room_page']);

Route::get('tours_activities_page', [AdminController::class, 'tours_activities_page']);



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

route::get('/tours_activities_details/{id}', [HomeController::class,'tours_activities_details']);


// Show booking form with room details
Route::get('book_room/{roomId}', [BookingController::class, 'showBookingForm'])->name('booking.form');
Route::get('book_tours_activities{tour_activity_id}', [BookingController::class, 'showBookingForm'])->name('booking.form');
// Store booking
Route::post('book_room', [BookingController::class, 'storeBooking'])->name('booking.store');

Route::post('booking_tour_activity', [BookingController::class, 'storeBookingOther'])->name('booking_store');

// Add a route for booking success


Route::get('book_room', [BookingController::class, 'storeBooking'])->name('book_room');
Route::get('booking_tour_activity', [BookingController::class, 'storeBookingOther'])->name('booking_tour_activity');


Route::get('/home_page', [BookingController::class, 'home_page'])->name('home_page');


Route::get('booking-success/{id}', [BookingController::class, 'showBookingSuccess']);

Route::get('/my_bookings', [BookingController::class, 'showBookings'])->name('my.bookings');

Route::get('/toggle_status/{id}', [AdminController::class, 'toggleStatus'])->name('toggle.status');

Route::get('/toggle.status/{id}', [AdminController::class, 'toggleStatusOther'])->name('toggle.statusother');

Route::get('/details_room/{room_id}', [AdminController::class, 'details_room'])->name('details_room');

Route::get('/details_tour/{tour_activity_id}', [AdminController::class, 'details_tour'])->name('details_tour');

Route::get('/details_activity/{tour_activity_id}', [AdminController::class, 'details_activity'])->name('details_activity');















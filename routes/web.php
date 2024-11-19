<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\HomeController;


use App\Http\Controllers\BookingController;

use App\Http\Controllers\UserReviewsController;

use App\Exports\BookingsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ReportController;


Route::get('/', [AdminController::class, 'home']);

route::get('/home', [AdminController::class, 'index'])->name('home');

// Routes protected by authentication middleware
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Optional separate routes for user dashboards
    Route::get('/user/dashboard', [AdminController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/superadmin/dashboard', [AdminController::class, 'superadminDashboard'])->name('superadmin.dashboard');
});

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

Route::get('/toggle-status/{id}', [AdminController::class, 'toggleStatus'])->name('toggle-status');

Route::get('/toggle.status/{id}', [AdminController::class, 'toggleStatusOther'])->name('toggle.statusother');

Route::get('/details_room/{room_id}', [AdminController::class, 'details_room'])->name('details_room');

Route::get('/details_tour/{tour_activity_id}', [AdminController::class, 'details_tour'])->name('details_tour');

Route::get('/details_activity/{tour_activity_id}', [AdminController::class, 'details_activity'])->name('details_activity');

Route::get('/view_roomBookings', [AdminController::class, 'view_roomBookings'])->name('view_roomBookings');
Route::get('/view_tourBookings', [AdminController::class, 'view_tourBookings'])->name('view_tourBookings');
Route::get('/view_activityBookings', [AdminController::class, 'view_activityBookings'])->name('view_activityBookings');


route::get('/approve_booking/{id}', [BookingController::class,'approve_booking']);

route::get('/approve_tour_activity/{id}', [BookingController::class,'approve_tour_activity']);


route::get('/reject_booking/{id}', [BookingController::class,'reject_booking']);

route::get('/reject_tour_activity/{id}', [BookingController::class,'reject_tour_activity']);

route::get('/cancel_bookingRoom/{id}', [BookingController::class,'cancel_bookingRoom']);

route::get('/cancel_bookingOther/{id}', [BookingController::class,'cancel_bookingOther']);

route::get('/remove_bookingRoom/{id}', [BookingController::class,'remove_bookingRoom']);

route::get('/remove_bookingOther/{id}', [BookingController::class,'remove_bookingOther']);

route::get('/ongoing_bookings', [BookingController::class,'ongoing_bookings']);
route::get('/ongoing_bookingOthers', [BookingController::class,'ongoing_bookingOthers']);

route::get('/update_ongoing/{id}', [BookingController::class,'update_ongoing']);

route::get('/update_ongoingOther/{id}', [BookingController::class,'update_ongoingOther']);

Route::get('/toggle_status/{id}', [BookingController::class, 'toggleStatus'])->name('toggle_status');

Route::get('/toggle_statusOther/{id}', [BookingController::class, 'toggleStatusOther'])->name('toggle_statusOther');

route::get('/reviews', [AdminController::class,'reviews']);

route::post('/my_finishedbookings', [HomeController::class,'my_finishedbookings']);




Route::post('/submit-review', [UserReviewsController::class, 'submitReview'])->middleware('auth');
Route::post('/submit-review-other', [UserReviewsController::class, 'submitReviewOther'])->name('submit-review-other');
Route::get('/export-bookings', function () {
    return Excel::download(new BookingsExport, 'bookings.xlsx');
})->name('export-bookings');





route::get('/report_generation', [AdminController::class,'report_generation']);

Route::get('/generate-invoice', [ReportController::class, 'generateInvoice'])->name('generate.invoice');

Route::get('/generate-invoice2', [ReportController::class, 'generateInvoice2'])->name('generate.invoice2');

Route::get('/tourist-analytics', [DataController::class, 'showTouristAnalytics'])
    ->name('tourist.analytics');



    Route::get('/hide_bookingRoom/{id}', [BookingController::class, 'hideBookingRoom'])->name('hideBookingRoom');
    Route::get('/hide_bookingOther/{id}', [BookingController::class, 'hideBookingOther'])->name('hideBookingOther');


    route::post('/contacts', [HomeController::class,'contacts']);

    Route::get('/all_messages', [HomeController::class, 'all_messages'])->name('messages');


    Route::post('/hide-all-finished-bookings', [BookingController::class, 'hideAllFinishedBookings'])->name('hideAllFinishedBookings');
    Route::post('/unhide-all-finished-bookings', [BookingController::class, 'unhideAllFinishedBookings'])->name('unhideAllFinishedBookings');
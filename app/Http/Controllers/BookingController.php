<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingOther;

use App\Models\Room;
use Illuminate\Http\Request;


use App\Models\RoomAvailability;
use App\Models\Tours_ActivitiesAvailability;


use App\Models\User;

use Illuminate\Support\Facades\Auth;



use App\Models\Tours_Activities;


use App\Models\RoomImage;
use App\Models\Tours_ActivitiesImage;


use Illuminate\Support\Facades\Hash;

class BookingController extends Controller
{
    public function storeBooking(Request $request)
{
    // Validate the incoming data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
        'size' => 'required|integer|min:1',
        'checkin_date' => 'required|date',
        'checkout_date' => 'required|date|after:checkin_date',
        'arrival_time' => 'required|date_format:H:i',
        'id_image' => 'required|image|mimes:jpeg,png,jpg,gif',
        'room_id' => 'required|exists:rooms,id', // Ensure room exists in the database
    ]);

    // Handle the file upload
    if ($request->hasFile('id_image')) {
        // Get the original file extension
        $extension = $request->file('id_image')->getClientOriginalExtension();
        
        // Generate a unique file name and store the file in 'public/id_images'
        $filename = uniqid('id_image_') . '.' . $extension;
        $path = $request->file('id_image')->move(public_path('id_images'), $filename);
    }

    // Generate a random 8-digit ticket
    $ticket = Booking::generateTicket();

    // Create the booking
    $booking = Booking::create([
        'user_id' => auth()->id(),
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'size' => $request->size,
        'checkin_date' => $request->checkin_date,
        'checkout_date' => $request->checkout_date,
        'arrival_time' => $request->arrival_time,
        'ticket' => $ticket,
        'id_image' => $path,
        'room_id' => $request->room_id,  // Store the room_id
    ]);

    // Store the ticket number in session to be used in the success page
    session(['ticket' => $ticket]);

    // Redirect to the booking success page and pass the booking data
    return redirect()->back()->with('success', 'Room added successfully with available dates.');
}


public function storeBookingOther(Request $request)
{
    // Validate the incoming data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
        'size' => 'required|integer|min:1',
        'checkin_date' => 'required|date',
        'checkout_date' => 'required|date|after:checkin_date',
        'arrival_time' => 'required|date_format:H:i',
        'id_image' => 'required|image|mimes:jpeg,png,jpg,gif',
        'tour_activity_id' => 'required|exists:tours__activities,id', // Ensure room exists in the database
    ]);

    // Handle the file upload
    if ($request->hasFile('id_image')) {
        // Get the original file extension
        $extension = $request->file('id_image')->getClientOriginalExtension();
        
        // Generate a unique file name and store the file in 'public/id_images'
        $filename = uniqid('id_image_') . '.' . $extension;
        $path = $request->file('id_image')->move(public_path('id_images'), $filename);
    }

    // Generate a random 8-digit ticket
    $ticket = BookingOther::generateTicket();

    // Create the booking
    $booking = BookingOther::create([
        'user_id' => auth()->id(),
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'size' => $request->size,
        'checkin_date' => $request->checkin_date,
        'checkout_date' => $request->checkout_date,
        'arrival_time' => $request->arrival_time,
        'ticket' => $ticket,
        'id_image' => $path,
        'tour_activity_id' => $request->tour_activity_id,  // Store the room_id
    ]);

    // Store the ticket number in session to be used in the success page
    session(['ticket' => $ticket]);

    // Redirect to the booking success page and pass the booking data
    return redirect()->back()->with('success', 'Added successfully with available dates.');
}

public function home()
{   
    $room = Room::all();
    $data = Tours_Activities::all();

    return view('home.index',compact('room', 'data'));
}


public function showBookingSuccess($id)
{
    $booking = Booking::findOrFail($id);
    
    // Pass the booking data to the view
    return view('home.my_bookings', compact('booking'));
}
public function showBookings()
{
    // Fetch bookings associated with the logged-in user
    $bookedRooms = Booking::where('user_id', auth()->id())->get();
    $otherBookings  = BookingOther::where('user_id', auth()->id())->get();

    // Pass the bookings to the view
    return view('home.my_bookings', compact('bookedRooms', 'otherBookings'));
}


}

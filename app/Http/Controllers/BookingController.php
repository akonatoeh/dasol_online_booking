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
use Carbon\Carbon;


class BookingController extends Controller
{
    public function storeBooking(Request $request)
{   
    $room = Room::find($request->room_id);

    if ($room->status === 'Out of Service') {
        return redirect()->back()->with('error', 'This room is currently out of service and cannot be booked.');
    }

    // Validate the incoming data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
        'rooms' => 'required|integer|min:1',
        'size' => 'required|integer|min:1',
        'size2' => 'required|integer',
        'foreigners' => 'required|integer',
        'checkin_date' => 'required|date',
        'checkout_date' => 'required|date|after:checkin_date',
        'arrival_time' => 'required|date_format:H:i',
        'id_image' => 'required|image|mimes:jpeg,png,jpg,gif',
        'room_id' => 'required|exists:rooms,id', // Ensure room exists in the database
    ]);

    // Handle the file upload
    $path = null;
    if ($request->hasFile('id_image')) {
        // Get the original file extension
        $extension = $request->file('id_image')->getClientOriginalExtension();
        
        // Generate a unique file name and store the file in 'public/id_images'
        $filename = uniqid('id_image_') . '.' . $extension;
        $request->file('id_image')->move(public_path('id_images'), $filename);
        
        // Save only the relative path
        $path = 'id_images/' . $filename;
    }

    // Generate a random 8-digit ticket
    $ticket = Booking::generateTicket();

    // Create the booking
    $booking = Booking::create([
        'user_id' => auth()->id(),
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'rooms' => $request->rooms,
        'size' => $request->size,
        'size2' => $request->size2,
        'foreigners' => $request->foreigners,
        'checkin_date' => $request->checkin_date,
        'checkout_date' => $request->checkout_date,
        'arrival_time' => $request->arrival_time,
        'ticket' => $ticket,
        'id_image' => $path,  // Save only the relative path in the database
        'room_id' => $request->room_id,  // Store the room_id
        'daily_count' => $request->size + $request->size2,
        
    ]);

    // Store the ticket number in session to be used in the success page
    session(['ticket' => $ticket]);
    // Redirect to the booking success page and pass the booking data
    return redirect()->back()->with('success', 'Room added successfully with available dates.');
}



public function storeBookingOther(Request $request)
{

    $data = Tours_Activities::find($request->tour_activity_id);

    if ($data->status === 'Out of Service') {
        return redirect()->back()->with('error', 'This room is currently out of service and cannot be booked.');
    }
    // Validate the incoming data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
        'size' => 'required|integer|min:1',
        'size2' => 'required|integer',
        'foreigners' => 'required|integer',
        'checkin_date' => 'required|date',
        'checkout_date' => 'required|date|after:checkin_date',
        'arrival_time' => 'required|date_format:H:i',
        'id_image' => 'required|image|mimes:jpeg,png,jpg,gif',
        'tour_activity_id' => 'required|exists:tours__activities,id', // Ensure room exists in the database
    ]);

    // Handle the file upload
    $path = null;
    if ($request->hasFile('id_image')) {
        // Get the original file extension
        $extension = $request->file('id_image')->getClientOriginalExtension();
        
        // Generate a unique file name and store the file in 'public/id_images'
        $filename = uniqid('id_image_') . '.' . $extension;
        $request->file('id_image')->move(public_path('id_images'), $filename);
        
        // Save only the relative path
        $path = 'id_images/' . $filename;
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
        'size2' => $request->size2,
        'foreigners' => $request->foreigners,
        'checkin_date' => $request->checkin_date,
        'checkout_date' => $request->checkout_date,
        'arrival_time' => $request->arrival_time,
        'ticket' => $ticket,
        'id_image' => $path,
        'tour_activity_id' => $request->tour_activity_id,  // Store the room_id
        'daily_count' => $request->size + $request->size2,
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
    // Fetch room bookings excluding 'Hidden' status
    $bookedRooms = Booking::where('user_id', auth()->id())
        ->whereNotIn('status', ['Hidden'])
        ->get();

    // Fetch other service bookings excluding 'Hidden' status
    $otherBookings = BookingOther::where('user_id', auth()->id())
        ->whereNotIn('status', ['Hidden'])
        ->get();

    return view('home.my_bookings', compact('bookedRooms', 'otherBookings'));
}

public function approve_booking($id)
{
$booking = Booking::find($id);

$booking->status = 'Approved';

$booking->save();

return redirect()->back();
}

public function approve_tour_activity($id)
{
$booking = BookingOther::find($id);

$booking->status = 'Approved';

$booking->save();

return redirect()->back();
}

public function reject_booking($id)
{
    $booking = Booking::find($id);

$booking->status = 'Rejected';

$booking->save();

return redirect()->back();
}

public function reject_tour_activity($id)
{
    $booking = BookingOther::find($id);

$booking->status = 'Rejected';

$booking->save();

return redirect()->back();
}

public function cancel_bookingRoom($id)
{
    $booking = Booking::find($id);

    $booking->status = 'Cancelled';

    $booking->save();

    return redirect()->back();
}

public function hideBookingRoom($id)
{
    // Find the booking by ID
    $booking = Booking::find($id);

 
        // Update the status to 'Hidden'
        $booking->status = 'Hidden';
        $booking->save();


    // If booking not found, return a failure response
    return redirect()->back()->with('Hidden Successfully.');
}

    public function hideBookingOther($id)
{
    // Find the booking by ID
    $booking = BookingOther::find($id);

 
        // Update the status to 'Hidden'
        $booking->status = 'Hidden';
        $booking->save();


    // If booking not found, return a failure response
    return redirect()->back()->with('Hidden Successfully.');

}
public function cancel_bookingOther($id)
{
    $booking = BookingOther::find($id);

    $booking->status = 'Cancelled';

    $booking->save();

    return redirect()->back();
}


public function ongoing_bookings()
{
    $bookedRooms = Booking::with('room') // Load room relationship
        ->latest() // Order by most recent bookings
        ->get();

    return view('admin.approved_rooms', compact('bookedRooms'));
}
public function ongoing_bookingOthers()
{
    $bookedRooms = BookingOther::with('data') // Load room relationship
        ->latest() // Order by most recent bookings
        ->get();

    return view('admin.approved_t_a', compact('bookedRooms'));
}



public function update_ongoing($id)
{
    $booking = Booking::find($id);

    $booking->status = 'Ongoing';

    $booking->save();

    return redirect()->back();
}

public function update_ongoingOthers($id)
{
    $booking = BookingOther::find($id);

    $booking->status = 'Ongoing';

    $booking->save();

    return redirect()->back();
}

public function toggleStatus($id)
    {
        $booking = Booking::find($id);
    
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }
    
        // Toggle the status
    $booking->status = $booking->status === 'Approved' ? 'Ongoing' : 'Finished';
    $booking->save();
    
        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function toggleStatusOther($id)
    {
        $booking = BookingOther::find($id);
    
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking Not found.');
        }
    
        // Toggle the status
        $booking->status = $booking->status === 'Approved' ? 'Ongoing' : 'Finished';
        $booking->save();
    
        return redirect()->back()->with('success', 'Status updated successfully.');
    }
    public function remove_booking($id)
{
     // Find the booking by ID
     $booking = Booking::find($id);

     // Check if booking exists
     if ($booking) {
         // Delete the booking
         $booking->delete();
 
         // Redirect back with success message
         return redirect()->back()->with('success', 'Booking deleted successfully.');
     }
 
     // Redirect back with error message if booking not found
     return redirect()->back()->with('error', 'Booking not found.');
}

public function remove_bookingOther($id)
{
     // Find the booking by ID
     $booking = BookingOther::find($id);

     // Check if booking exists
     if ($booking) {
         // Delete the booking
         $booking->delete();
 
         // Redirect back with success message
         return redirect()->back()->with('success', 'Booking deleted successfully.');
     }
 
     // Redirect back with error message if booking not found
     return redirect()->back()->with('error', 'Booking not found.');
}



}




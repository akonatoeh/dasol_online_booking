<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RoomAvailability;
use App\Models\Tours_ActivitiesAvailability;


use App\Models\User;

use Illuminate\Support\Facades\Auth;

use App\Models\Room;
use App\Models\Booking;
use App\Models\BookingOther;



use App\Models\Tours_Activities;


use App\Models\RoomImage;
use App\Models\Tours_ActivitiesImage;

use App\Models\Contact;


use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{   

    
    public function room_details($id)
{
    // Load the room details
    $room = Room::where('id', $id)->with('availabilities', 'bookings')->firstOrFail();

    // Decode the offers and contacts JSON
    $offers = json_decode($room->offers);
    $contacts = json_decode($room->contacts, true);

    // Calculate restricted dates dynamically
    $restrictedDates = [];
    $restrictedFromCheckin = []; // Additional array for restrictions starting from check-in
    $dateBookings = [];

    foreach ($room->bookings->where('status', 'Approved') as $booking) {
        $start = new \DateTime($booking->checkin_date);
        $end = new \DateTime($booking->checkout_date);

        while ($start <= $end) {
            $date = $start->format('Y-m-d');
            if (!isset($dateBookings[$date])) {
                $dateBookings[$date] = 0;
            }
            $dateBookings[$date] += $booking->rooms; // Increment by number of rooms booked
            $start->modify('+1 day');
        }
    }

    // Restrict dates where bookings equal or exceed room capacity
    foreach ($dateBookings as $date => $totalBookedRooms) {
        if ($totalBookedRooms >= $room->available_rooms) {
            $restrictedDates[] = $date;
            $restrictedFromCheckin[] = $date;
        }
    }

    // Extract unique years for dropdown
    $years = $room->availabilities
        ->map(function ($availability) {
            return date('Y', strtotime($availability->available_date));
        })
        ->unique()
        ->sort()
        ->values()
        ->toArray();

    // Return the view with necessary data
    return view('home.room_details', compact('room', 'contacts', 'years', 'offers', 'restrictedDates', 'restrictedFromCheckin'));
}


public function tours_activities_details($id)
{
    // Load the tour or activity details with availabilities and booking_others
    $data = Tours_Activities::where('id', $id)
        ->with(['availabilities', 'bookings']) // Load necessary relationships
        ->firstOrFail();

    // Decode the offers JSON
    $offers = json_decode($data->offers);

    // Decode the contacts JSON
    $contacts = json_decode($data->contacts, true);

    // Calculate restricted dates dynamically
    $restrictedDates = [];
    $restrictedFromCheckin = [];
    $dateBookings = [];

    foreach ($data->bookings->where('status', 'Approved') as $booking) {
        $start = new \DateTime($booking->checkin_date);
        $end = new \DateTime($booking->checkout_date);

        while ($start <= $end) {
            $date = $start->format('Y-m-d');
            if (!isset($dateBookings[$date])) {
                $dateBookings[$date] = 0;
            }
            $dateBookings[$date] += $booking->avail_service; // Increment by the number of tickets booked
            $start->modify('+1 day');
        }

        // Add check-in date to restrictedFromCheckin
        $restrictedFromCheckin[] = $booking->checkin_date;
    }

    // Restrict dates where bookings equal or exceed the maximum capacity
    foreach ($dateBookings as $date => $totalBookedTickets) {
        if ($totalBookedTickets >= $data->available_service) {
            $restrictedDates[] = $date;
        }
    }

    // Extract unique years from availabilities
    $years = $data->availabilities
        ->map(function ($availability) {
            return date('Y', strtotime($availability->available_date));
        })
        ->unique()
        ->sort()
        ->values()
        ->toArray();

    // Return the view with necessary data
    return view('home.toursandactivities_details', compact('data', 'years', 'offers', 'contacts', 'restrictedDates', 'restrictedFromCheckin'));
}

    public function contacts(Request $request)
    {
        $contact = new Contact;

        $contact->name = $request-> name;
        $contact->email = $request-> email;
        $contact->phone = $request-> phone;
        $contact->message = $request-> message;
        $contact->user_id = Auth::id();
        $contact->save();
        

        return redirect()->back()->with('message','Message Sent Successfuly');

    }

        public function all_messages(Request $request)
    {
        $contact = Contact::all(); // Fetch all contact records
        return view('superadmin.messages', compact('contact')); // Pass data to the view
    }
    

    public function my_finishedbookings()
    {
        $bookedRooms = BookedRoom::where('status', 'Finished')->paginate(5); // Adjust items per page
$otherBookings = OtherBooking::where('status', 'Finished')->paginate(5);
$allBookings = $bookedRooms->merge($otherBookings)->paginate(5);
return view('home.my_finishedbookings', compact('bookedRooms', 'otherBookings'));
    }
}

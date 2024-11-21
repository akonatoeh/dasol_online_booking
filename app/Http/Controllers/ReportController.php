<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingOther;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function generateInvoice()
{
    // Fetch bookings where the logged-in admin owns the room and status is Ongoing or Finished
    $bookings = Booking::whereHas('room', function ($query) {
        $query->where('user_id', Auth::id()); // Replace 'user_id' if the column name is different
    })
    ->whereIn('status', ['Ongoing', 'Finished', '']) // Filter bookings with status Ongoing or Finished
    ->get();

    // Calculate the total amount for all bookings
    $total = $bookings->sum(function ($booking) {
        $duration = \Carbon\Carbon::parse($booking->checkin_date)->diffInDays($booking->checkout_date);
        return $booking->rooms * $booking->room->price * $duration;
    });

    // Prepare data for the invoice
    $data = [
        'business_name' => Auth::user()->business_name ?? 'Your Business Name',
        'date' => now()->format('Y-m-d'),
        'items' => $bookings->map(function ($booking) {
            $duration = \Carbon\Carbon::parse($booking->checkin_date)->diffInDays($booking->checkout_date);
            return [
                'size' => $booking->size,
                'size2' => $booking->size2,
                'foreigners' => $booking->foreigners,
                'ticket' => $booking->ticket,
                'room_name' => $booking->room->room_title ?? 'N/A',
                'room_name' => $booking->room->room_type ?? 'N/A',
                'name' => $booking->name ?? 'N/A', // Ensure the 'room' relationship exists in Booking model
                'email' => $booking->email,
                'phone' => $booking->phone,
                'price' => $booking->room->price ?? 0,
                'rooms' => $booking->rooms,
                'checkin_date' => $booking->checkin_date,
                'checkout_date' => $booking->checkout_date,
                'duration' => $duration . ' ' . \Illuminate\Support\Str::plural('day', $duration),
                'amount' => $booking->rooms * $booking->room->price * $duration,
                'total_guest' => $booking->size + $booking->size2 ,
            ];
        }),
        'total' => $total,
    ];

    // Generate the PDF
    $pdf = PDF::loadView('admin.invoice', $data);

    // Return the PDF as a downloadable file
    return $pdf->download('invoice.pdf');
}
    public function generateInvoice2()
{
    // Fetch bookings where the logged-in admin owns the room and status is Ongoing or Finished
    $bookings = BookingOther::whereHas('data', function ($query) {
        $query->where('user_id', Auth::id()); // Replace 'user_id' if the column name is different
    })
    ->whereIn('status', ['Ongoing', 'Finished']) // Filter bookings with status Ongoing or Finished
    ->get();

    // Prepare data for the invoice
    $data = [
        'business_name' => Auth::user()->business_name ?? 'Your Business Name',
        'date' => now()->format('Y-m-d'),
        'items' => $bookings->map(function ($booking) {
            $duration = \Carbon\Carbon::parse($booking->checkin_date)->diffInDays($booking->checkout_date);
            return [
                'size' => $booking->size,
                'size2' => $booking->size2,
                'foreigners' => $booking->foreigners,
                'ticket' => $booking->ticket,
                'service_name' => $booking->data->title ?? 'N/A',
                'service_type' => $booking->data->type ?? 'N/A',
                'type' => 'Service Bookings',
                'name' => $booking->name ?? 'N/A', // Ensure the 'room' relationship exists in Booking model
                'email' => $booking->email,
                'phone' => $booking->phone,
                'price' => $booking->data->price ?? 0,
                'checkin_date' => $booking->checkin_date,
                'checkout_date' => $booking->checkout_date,
                'duration' => $duration . ' ' . \Illuminate\Support\Str::plural('day', $duration),
                'amount' => $booking->size * $booking->size2 *$booking->foreigners * $booking->data->price * $duration,
                'total_guest' => $booking->size + $booking->size2 ,
            ];
        }),
      
    ];

    // Generate the PDF
    $pdf = PDF::loadView('admin.invoice2', $data);

    // Return the PDF as a downloadable file
    return $pdf->download('invoice.pdf');
}

public function generateInvoice3()
{
    // Fetch room bookings where the logged-in admin owns the room and the status is Ongoing or Finished
    $roomBookings = Booking::whereHas('room', function ($query) {
        $query->where('user_id', Auth::id());
    })
    ->whereIn('status', ['Ongoing', 'Finished'])
    ->get();

    // Fetch service bookings where the logged-in admin owns the service and the status is Ongoing or Finished
    $serviceBookings = BookingOther::whereHas('data', function ($query) {
        $query->where('user_id', Auth::id());
    })
    ->whereIn('status', ['Ongoing', 'Finished'])
    ->get();

    // Combine data from both sources into a single collection
    $items = $roomBookings->map(function ($booking) {
        return [
            'ticket' => $booking->ticket ?? 'N/A',
            'name' => $booking->name ?? 'N/A',
            'email' => $booking->email ?? 'N/A',
            'phone' => $booking->phone ?? 'N/A',
            'adults' => $booking->size ?? 0,
            'children' => $booking->size2 ?? 0,
            'foreigners' => $booking->foreigners ?? 0,
        ];
    })->merge(
        $serviceBookings->map(function ($booking) {
            return [
                'ticket' => $booking->ticket ?? 'N/A',
                'name' => $booking->name ?? 'N/A',
                'email' => $booking->email ?? 'N/A',
                'phone' => $booking->phone ?? 'N/A',
                'adults' => $booking->size ?? 0,
                'children' => $booking->size2 ?? 0,
                'foreigners' => $booking->foreigners ?? 0,
            ];
        })
    );

    // Calculate total tourists
    $totalTourists = $items->sum(function ($item) {
        return $item['adults'] + $item['children'] + $item['foreigners'];
    });

    // Prepare data for the report
    $data = [
        'business_name' => Auth::user()->business_name ?? 'Your Business Name',
        'date' => now()->format('Y-m-d'),
        'items' => $items->toArray(),
        'total_tourists' => $totalTourists,
    ];

    // Generate the PDF
    $pdf = PDF::loadView('admin.invoice3', $data);

    // Return the PDF as a downloadable file
    return $pdf->download('invoice3.pdf');
}

public function displayTouristPerDay()
{
    // Fetch bookings from Booking table
    $roomBookings = Booking::whereDate('checkin_date', now()->format('Y-m-d')) // Example for today
        ->whereIn('status', ['Ongoing', 'Finished']) // Filter bookings with status Ongoing or Finished
        ->get();

    // Fetch bookings from BookingOther table
    $otherBookings = BookingOther::whereDate('checkin_date', now()->format('Y-m-d')) // Example for today
        ->whereIn('status', ['Ongoing', 'Finished']) // Filter bookings with status Ongoing or Finished
        ->get();

    // Prepare data to display tourist details
    $data = [
        'date' => now()->format('Y-m-d'),
        'tourists' => $roomBookings->map(function ($booking) {
            return [
                'name' => $booking->name ?? 'N/A',
                'service_type' => 'Room',
                'phone' => $booking->phone,
                'adults' => $booking->size,   // Size corresponds to adults
                'children' => $booking->size2, // Size2 corresponds to children
                'foreigners' => $booking->foreigners, // Foreigners count
            ];
        })->merge(
            $otherBookings->map(function ($booking) {
                return [
                    'name' => $booking->name ?? 'N/A',
                    'service_type' => $booking->data->type ?? 'Other Booking', // Service type from other data
                    'phone' => $booking->phone,
                    'adults' => $booking->size,   // Size corresponds to adults
                    'children' => $booking->size2, // Size2 corresponds to children
                    'foreigners' => $booking->foreigners, // Foreigners count
                ];
            })
        ),
    ];

    // Assuming you want to return the data or view the results
    return view('admin.tourists_per_day', $data); // Create a Blade view to display this info
}
}


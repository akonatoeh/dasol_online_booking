<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingOther;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function showTouristAnalytics()
    {
        // Fetch totals from bookings table
        $totalBooking = DB::table('bookings')
            ->whereIn('status', ['Ongoing', 'Finished'])
            ->selectRaw('SUM(size + size2 + foreigners) as total')
            ->value('total');

        // Fetch totals from booking_others table
        $totalBookingOthers = DB::table('booking_others')
            ->whereIn('status', ['Ongoing', 'Finished'])
            ->selectRaw('SUM(size + size2 + foreigners) as total')
            ->value('total');

        // Ensure null values are handled
        $totalBooking = $totalBooking ?? 0;
        $totalBookingOthers = $totalBookingOthers ?? 0;

        // Calculate the grand total
        $totalTourists = $totalBooking + $totalBookingOthers;

        // Debug output (optional)
        // dd($totalBooking, $totalBookingOthers, $totalTourists);

        // Pass all variables to the view
        return view('superadmin.superadmin', compact('totalBooking', 'totalBookingOthers', 'totalTourists'));
    }
}
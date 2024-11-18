<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataController extends Controller
{
    public function showTouristAnalytics()
    {
        // Get today's date
        $today = Carbon::today();

        // Fetch totals from bookings table for today's data
        $totalBooking = DB::table('bookings')
            ->whereDate('created_at', $today)
            ->whereIn('status', ['Ongoing', 'Finished'])
            ->sum(DB::raw('size + size2')); // Directly sum the fields

        // Fetch totals from booking_others table for today's data
        $totalBookingOthers = DB::table('booking_others')
            ->whereDate('created_at', $today)
            ->whereIn('status', ['Ongoing', 'Finished'])
            ->sum(DB::raw('size + size2'));

        // Calculate the grand total
        $totalTourists = ($totalBooking ?? 0) + ($totalBookingOthers ?? 0);

        // Pass all variables to the view
        return view('superadmin.superadmin', compact('totalBooking', 'totalBookingOthers', 'totalTourists'));
    }
}
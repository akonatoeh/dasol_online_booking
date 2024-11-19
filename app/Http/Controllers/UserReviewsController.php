<?php

// ReviewsController.php
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

use App\Models\Review;
use App\Models\ReviewOther;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserReviewsController extends Controller
{
    public function submitReview(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id', // Validate booking_id exists
            'room_id' => 'required|exists:rooms,id', // Validate room_id exists
            'rating' => 'required|integer|min:1|max:5', // Validate rating range
            'comment' => 'nullable|string|max:1000', // Optional comment
        ]);
    
        // Create the review
        Review::create([
            'booking_id' => $validated['booking_id'],
            'room_id' => $validated['room_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);
    
        return redirect()->back()->with('success', 'Review added successfully.');
    }

    public function submitReviewOther(Request $request)
    {
        $validated = $request->validate([
            'booking_other_id' => 'required|exists:booking_others,id', // Validate booking_id exists
            'service_id' => 'required|exists:tours__activities,id', // Validate room_id exists
            'rating' => 'required|integer|min:1|max:5', // Validate rating range
            'comment' => 'nullable|string|max:1000', // Optional comment
        ]);
    
        // Create the review
        ReviewOther::create([
            'booking_other_id' => $validated['booking_other_id'],
            'service_id' => $validated['service_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);
    
        return redirect()->back()->with('success', 'Review added successfully.');
    }
}

<?php

// ReviewsController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class UserReviewsController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create($validated);

        return redirect()->back()->with('success', 'Review added successfully.');
    }
}


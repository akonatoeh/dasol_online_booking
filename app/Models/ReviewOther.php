<?php

// Review.php (Model)
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewOther extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'reviewsother'; // Specify the table name
    protected $fillable = ['booking_other_id', 'service_id', 'rating', 'comment']; // Fillable fields

    /**
     * Define the inverse relationship with Booking.
     */
    public function bookingOther()
    {
        return $this->belongsTo(BookingOther::class, 'tour_activity_id');
    }
}



<?php

// Review.php (Model)
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'room_id', 'rating', 'comment'];

    /**
     * Define the inverse relationship with Booking.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'room_id');
    }
}



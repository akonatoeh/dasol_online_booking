<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingOther extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'size',
        'checkin_date',
        'checkout_date',
        'arrival_time',
        'ticket',
        'id_image',
        'user_id',
        'tour_activity_id', // Ensure room_id is fillable
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Define the relationship with the Room model
    
    public function data() {
        return $this->belongsTo(Tours_Activities::class, 'tour_activity_id');
    }

    // Method to generate a random 8-digit ticket
    public static function generateTicket()
    {
        return rand(10000000, 99999999); // Generates a random 8-digit number
    }
 
}

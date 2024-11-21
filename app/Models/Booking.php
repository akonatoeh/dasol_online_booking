<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'rooms',
        'size',
        'size2',
        'foreigners',
        'business_name',
        'checkin_date',
        'checkout_date',
        'arrival_time',
        'ticket',
        'id_image',
        'user_id',
        'room_id', // Ensure room_id is fillable
        'daily_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Define the relationship with the Room model
    public function room()
{
    return $this->belongsTo(Room::class);
}

public function data()
{
    return $this->belongsTo(Tours_Activities::class, 'tour_activity_id');
}

    // Method to generate a random 8-digit ticket
    public static function generateTicket()
    {
        return rand(10000000, 99999999); // Generates a random 8-digit number
    }
  
    public function reviews()
    {
        return $this->hasMany(Review::class, 'room_id');
    }

}

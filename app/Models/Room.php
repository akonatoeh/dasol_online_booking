<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\RoomAvailability;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_title',
        'room_image',
        'description',
        'location',
        'price',
        'wifi',
        'room_type',
        'contacts'

    ];

// app/Models/Room.php
public function bookings()
    {
        return $this->hasMany(Booking::class, 'room_id');
    }

public function availabilities()
{
    return $this->hasMany(RoomAvailability::class);
}

public function additionalImages()
{
    return $this->hasMany(AdditionalImage::class);
}

public function images()
{
    return $this->hasMany(RoomImage::class, 'room_id');
}
}



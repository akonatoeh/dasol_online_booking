<?php
// app/Models/RoomAvailability.php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RoomAvailability extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'available_date'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}


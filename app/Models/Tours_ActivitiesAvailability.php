<?php
// app/Models/RoomAvailability.php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Tours_Activities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tours_ActivitiesAvailability extends Model
{
    use HasFactory;

    protected $fillable = ['tours_activities_id', 'available_date'];

    public function tours_activities()
    {
        return $this->belongsTo(Tours_Activities::class);
    }
}


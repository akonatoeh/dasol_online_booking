<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Tours_ActivitiesAvailability;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tours_Activities extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'image',
        'description',
        'location',
        'price',
        'type',
        'contacts'
    ];

// app/Models/Room.php

public function bookings()
    {
        return $this->hasMany(BookingOther::class, 'tour_activity_id');
    }

public function availabilities()
{
    return $this->hasMany(Tours_ActivitiesAvailability::class, 'tours_activities_id');
}

public function additionalImages()
{
    return $this->hasMany(AdditionalImage::class);
}

public function images()
{
    return $this->hasMany(Tours_ActivitiesImage::class, 'tours_activities_id');
}


}



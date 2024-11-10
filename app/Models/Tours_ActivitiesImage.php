<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tours_ActivitiesImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'tours_activities_id',
        'image_path',
    ];

    // Define relationship to the Room model
    public function tours_activities()
    {
        return $this->belongsTo(Tours_Activities::class);
    }
}

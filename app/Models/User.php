<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\RoomAvailability;
use App\Models\Tours_ActivitiesAvailability;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Disable auto-incrementing
    public $incrementing = false;

    // Set the key type to string since we are using a 4-digit string ID
    protected $keyType = 'string';

    // Mass assignable attributes
    protected $fillable = [
        'id', 'name', 'business_name', 'email', 'password', 'phone', 'usertype'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate a 4-digit ID before creating a user
        static::creating(function ($user) {
            do {
                $user->id = random_int(1000, 9999);  // Generate random 4-digit number
            } while (User::where('id', $user->id)->exists());  // Ensure it's unique
        });
    }

    // Automatically hash the password before storing it
    public function setPasswordAttribute($password)
    {
        // Only hash the password if it's not already hashed
        if (Hash::needsRehash($password)) {
            $this->attributes['password'] = Hash::make($password);
        } else {
            $this->attributes['password'] = $password;
        }
    }
}

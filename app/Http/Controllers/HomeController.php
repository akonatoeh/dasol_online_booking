<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RoomAvailability;
use App\Models\Tours_ActivitiesAvailability;


use App\Models\User;

use Illuminate\Support\Facades\Auth;

use App\Models\Room;
use App\Models\Booking;
use App\Models\BookingOther;



use App\Models\Tours_Activities;


use App\Models\RoomImage;
use App\Models\Tours_ActivitiesImage;


use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{
    public function room_details($id)
    {
        $room = Room::find($id);
        $offers = json_decode($room->offers); // Decode the offers JSON
        $contacts = json_decode($room->contacts, true); // Using true to get an array instead of an object
        return view('home.room_details', compact('room', 'contacts'));
    }

    public function tours_activities_details($id)
    {
        $data = Tours_Activities::find($id);
        $offers = json_decode($data->offers); // Decode the offers JSON
        $contacts = json_decode($data->contacts); 
        return view('home.toursandactivities_details', compact('data'));
    }

}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RoomAvailability;
use App\Models\Tours_ActivitiesAvailability;


use App\Models\User;

use Illuminate\Support\Facades\Auth;

use App\Models\Room;

use App\Models\Tours_Activities;


use App\Models\RoomImage;
use App\Models\Tours_ActivitiesImage;


use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{
    public function room_details($id)
    {
        $room = Room::find($id);

        return view('home.room_details', compact('room'));
    }
}

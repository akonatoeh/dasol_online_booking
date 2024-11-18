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

use App\Models\Contact;



use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{   

    
    public function room_details($id)
    {
        // Load the room details
        $room = Room::where('id', $id)
            ->with('availabilities') // Ensure relationship is loaded
            ->firstOrFail();

        // Decode the offers JSON
        $offers = json_decode($room->offers);

        // Decode the contacts JSON
        $contacts = json_decode($room->contacts, true);

        // Extract unique years from availabilities
        $years = $room->availabilities
            ->map(function ($availability) {
                return date('Y', strtotime($availability->available_date));
            })
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        // Return the view with the necessary data
        return view('home.room_details', compact('room', 'contacts', 'years', 'offers'));
    }



    public function tours_activities_details($id)
    {
         $data = Tours_Activities::where('id', $id)
         ->with('availabilities') // Ensure relationship is loaded
         ->firstOrFail();

     // Decode the offers JSON
     $offers = json_decode($data->offers);

     // Decode the contacts JSON
     $contacts = json_decode($data->contacts, true);

     // Extract unique years from availabilities
     $years = $data->availabilities
         ->map(function ($availability) {
             return date('Y', strtotime($availability->available_date));
         })
         ->unique()
         ->sort()
         ->values()
         ->toArray();

        return view('home.toursandactivities_details', compact('data', 'years'));
    }


    public function contacts(Request $request)
    {
        $contact = new Contact;

        $contact->name = $request-> name;
        $contact->email = $request-> email;
        $contact->phone = $request-> phone;
        $contact->message = $request-> message;
        $contact->user_id = Auth::id();
        $contact->save();
        

        return redirect()->back()->with('message','Message Sent Successfuly');

    }
}

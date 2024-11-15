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




class AdminController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $usertype = Auth()->user()->usertype;

            if ($usertype == 'user')
            {
                $room = Room::all();
                $data = Tours_Activities::all();

                return view('home.index',compact('room', 'data'));
            }

            else if ($usertype == 'superadmin')
            {
                return view('superadmin.superadmin');
            }

            else if ($usertype == 'admin')
            {
                return view('admin.index');
            }

            else 
            {
                return redirect()->back();
            }
        }
    }

    public function admin_home()
    {
        return view('admin.index');
    }

    public function superadmin_home()
    {
        return view('superadmin.superadmin');
    }

    public function home()
    {   
        $room = Room::all();
        $data = Tours_Activities::all();
        return view('home.index',compact('room','data'));
    }

    public function about()
    {
        return view('home.aboutpage');
    }

    public function room_page()
    {
        $rooms = Room::paginate(12, ['*'], 'rooms');
        return view('home.roompage', compact('rooms'));
    }

    public function tours_activities_page()
    {   
        $datas = Tours_Activities::paginate(12, ['*'], 'datas');
        return view('home.tours_activitiespage', compact('datas'));
    }

    public function create_room()
    {
        return view('admin.create_room');
    }

    public function add_room(Request $request)
    {
        $data = new Room();
        $data->room_title = $request->title;
        $data->description = $request->description;
        $data->new_location = $request->location;
        $data->price = $request->price;
        $data->max_adults = $request->max_adults;
        $data->max_children = $request->max_children;
        $data->available_rooms = $request->available_rooms;
        $data->room_type = $request->type;
        $data->user_id = Auth::id();


        // Encode the offers array to JSON before saving
        $data->offers = json_encode(json_decode($request->offers, true)); // Ensure it's JSON-encoded

        $data->contacts = json_encode(json_decode($request->contacts, true));
        /*$room_image=$request->image;
        
        if($room_image)
        {
            $imagename=time().'.'.$room_image->getClientOriginalExtension();

            $request->image->move('room',$imagename);

            $data->room_image=$imagename;
        }*/
        $data->save();
    
        // Handle the main room image if provided
    if ($request->hasFile('image')) {
        $room_image = $request->file('image');
        $imagename = time() . '.' . $room_image->getClientOriginalExtension();
        $room_image->move(public_path('room'), $imagename);
        $data->room_image =  $imagename;
        $data->save(); // Save the main room image path
    }

    // Handle additional images if provided
    if ($request->hasFile('additionalImages')) {
        foreach ($request->file('additionalImages') as $additionalImage) {
            $imageName = time() . '_' . $additionalImage->getClientOriginalName();
            $additionalImage->move(public_path('room_images'), $imageName);
            // Save each additional image to the RoomImage table
            RoomImage::create([
                'room_id' => $data->id,  // Use the room_id from the saved Room instance
                'image_path' =>  $imageName,
            ]);
        }
    }


        $data->user_id = Auth::id(); 

        $data->save();
        if ($request->available_dates) {
            // Split the comma-separated string into an array of dates
            $dates = explode(',', $request->available_dates);
    
            // Loop through each date and insert it individually
            foreach ($dates as $date) {
                RoomAvailability::create([
                    'room_id' => $data->id,
                    'available_date' => trim($date), // Insert each date one by one
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'Room added successfully with available dates.');
    }

    public function view_room()
{
    $userId = Auth::id();

    // Fetch the rooms that belong to this user and load the availabilities relationship
    $data = Room::where('user_id', $userId)->with('availabilities')->get();
    // Pass the data to the view
    return view('admin.view_room', compact('data'));
}


    public function edit_room(Request $request, $id)
{
    $data = Room::find($id);

    // Update basic room information
    $data->room_title = $request->title;
    $data->description = $request->description;
    $data->max_adults = $request->input('max_adults');
    $data->max_children = $request->input('max_children');
    $data->price = $request->price;
    $data->room_type = $request->type;
    $data->offers = json_encode(json_decode($request->offers, true)); // Ensure it's JSON-encoded
    $data->contacts = json_encode(json_decode($request->contacts, true));
    $data->user_id = Auth::id(); 
    $data->save();

    // Remove existing front image if requested
    if ($request->removedFrontImage === 'true' && $data->room_image) {
        if (file_exists(public_path('room/' . $data->room_image))) {
            unlink(public_path('room/' . $data->room_image));
        }
        $data->room_image = null; // Clear the front image
        $data->save();
    }

    // Handle new front image upload
    if ($request->hasFile('image')) {
        $room_image = $request->file('image');
        $imagename = time() . '.' . $room_image->getClientOriginalExtension();
        $room_image->move(public_path('room'), $imagename);
        $data->room_image = $imagename;
        $data->save(); // Save the main room image path
    }

    // Remove selected additional images
    if ($request->removedAdditionalImages) {
        $removedImages = json_decode($request->removedAdditionalImages, true);
        foreach ($removedImages as $imageId) {
            $image = RoomImage::find($imageId);
            if ($image && file_exists(public_path('room_images/' . $image->image_path))) {
                unlink(public_path('room_images/' . $image->image_path));
                $image->delete();
            }
        }
    }

    // Handle new additional images upload
    if ($request->hasFile('additionalImages')) {
        foreach ($request->file('additionalImages') as $additionalImage) {
            $imageName = time() . '_' . $additionalImage->getClientOriginalName();
            $additionalImage->move(public_path('room_images'), $imageName);
            RoomImage::create([
                'room_id' => $data->id,
                'image_path' => $imageName,
            ]);
        }
    }

    if (!$request->available_dates) {
        RoomAvailability::where('room_id', $data->id)->delete(); // Clear all existing dates
    } else {
        RoomAvailability::where('room_id', $data->id)->delete();
    
        $dates = explode(',', $request->available_dates);
        foreach ($dates as $date) {
            RoomAvailability::create([
                'room_id' => $data->id,
                'available_date' => trim($date),
            ]);
        }
    }

    return redirect()->back()->with('success', 'Room updated successfully, and images have been updated.');
}

public function edit_activity(Request $request, $id)
    {
        $data = Tours_Activities::find($id);

        $data->title = $request->title;

        $data->description = $request->description;
        $data->max_adults = $request->input('max_adults');
        $data->max_children = $request->input('max_children');

        $data->price = $request->price;

        $data->location = $request->location;
        $data->contacts = $request->contacts;
        $data->offers = json_encode(json_decode($request->offers, true)); // Ensure it's JSON-encoded

        $data->contacts = json_encode(json_decode($request->contacts, true));
        $data->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('tours_activities'), $imagename);
            $data->image =  $imagename;
            $data->save(); // Save the main room image path
        }

        // Update additional images
    if ($request->hasFile('additionalImages')) {
        // Delete existing additional images
        $existingImages = Tours_ActivitiesImage::where('tours_activities_id', $data->id)->get();
        foreach ($existingImages as $existingImage) {
            if (file_exists(public_path('tours_activitiesAdditionalImages/' . $existingImage->image_path))) {
                unlink(public_path('tours_activitiesAdditionalImages/' . $existingImage->image_path));
            }
            $existingImage->delete();
        }

        // Save new additional images
        foreach ($request->file('additionalImages') as $additionalImage) {
            $imageName = time() . '_' . $additionalImage->getClientOriginalName();
            $additionalImage->move(public_path('tours_activitiesAdditionalImages'), $imageName);
            Tours_ActivitiesImage::create([
                'tours_activities_id' => $data->id,
                'image_path' => $imageName,
            ]);
        }
    }
    $data->user_id = Auth::id(); 
$data->save();

if ($request->available_dates) {
    // Remove existing available dates for the room
    Tours_ActivitiesAvailability::where('tours_activities_id', $data->id)->delete();

    // Split the comma-separated string into an array of dates
    $dates = explode(',', $request->available_dates);

    // Loop through each date and insert it individually
    foreach ($dates as $date) {
        Tours_ActivitiesAvailability::create([
            'tours_activities_id' => $data->id,
            'available_date' => trim($date), // Insert each date one by one
        ]);
    }
}
    return redirect()->back()->with('success', 'Activity updated successfully, and images have been replaced.');
}
public function edit_tour(Request $request, $id)
    {
        $data = Tours_Activities::find($id);

        $data->title = $request->title;

        $data->description = $request->description;
        $data->max_adults = $request->input('max_adults');
        $data->max_children = $request->input('max_children');
        $data->price = $request->price;

        $data->location = $request->location;
        $data->contacts = $request->contacts;

        $data->offers = json_encode(json_decode($request->offers, true)); // Ensure it's JSON-encoded

        $data->contacts = json_encode(json_decode($request->contacts, true));

        $data->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('tours_activities'), $imagename);
            $data->image =  $imagename;
            $data->save(); // Save the main room image path
        }

        // Update additional images
    if ($request->hasFile('additionalImages')) {
        // Delete existing additional images
        $existingImages = Tours_ActivitiesImage::where('tours_activities_id', $data->id)->get();
        foreach ($existingImages as $existingImage) {
            if (file_exists(public_path('tours_activitiesAdditionalImages/' . $existingImage->image_path))) {
                unlink(public_path('tours_activitiesAdditionalImages/' . $existingImage->image_path));
            }
            $existingImage->delete();
        }

        // Save new additional images
        foreach ($request->file('additionalImages') as $additionalImage) {
            $imageName = time() . '_' . $additionalImage->getClientOriginalName();
            $additionalImage->move(public_path('tours_activitiesAdditionalImages'), $imageName);
            Tours_ActivitiesImage::create([
                'tours_activities_id' => $data->id,
                'image_path' => $imageName,
            ]);
        }
    }
    $data->user_id = Auth::id(); 
$data->save();

if ($request->available_dates) {
    // Remove existing available dates for the room
    Tours_ActivitiesAvailability::where('tours_activities_id', $data->id)->delete();

    // Split the comma-separated string into an array of dates
    $dates = explode(',', $request->available_dates);

    // Loop through each date and insert it individually
    foreach ($dates as $date) {
        Tours_ActivitiesAvailability::create([
            'tours_activities_id' => $data->id,
            'available_date' => trim($date), // Insert each date one by one
        ]);
    }
}
    return redirect()->back()->with('success', 'Tour updated successfully, and images have been replaced.');
}

public function create_tours_activities()
    {
        return view('admin.create_tours_activities');
    }

    public function add_tours_activities(Request $request)
    {
        $data = new Tours_Activities();
        $data->title = $request->title;
        $data->description = $request->description;
        $data->location = $request->location;
        $data->price = $request->price;
        $data->max_adults = $request->max_adults;
        $data->max_children = $request->max_children;
        $data->contacts = $request->contacts;
        $data->type = $request->type;
        $data->user_id = Auth::id();

        $data->offers = json_encode(json_decode($request->offers, true)); // Ensure it's JSON-encoded

        $data->contacts = json_encode(json_decode($request->contacts, true));
        /*$room_image=$request->image;
        
        if($room_image)
        {
            $imagename=time().'.'.$room_image->getClientOriginalExtension();

            $request->image->move('room',$imagename);

            $data->room_image=$imagename;
        }*/
        $data->save();
    
        // Handle the main room image if provided
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('tours_activities'), $imagename);
        $data->image =  $imagename;
        $data->save(); // Save the main room image path
    }

    // Handle additional images if provided
    if ($request->hasFile('additionalImages')) {
        foreach ($request->file('additionalImages') as $additionalImage) {
            $imageName = time() . '_' . $additionalImage->getClientOriginalName();
            $additionalImage->move(public_path('tours_activitiesAdditionalImages'), $imageName);
            // Save each additional image to the RoomImage table
            Tours_ActivitiesImage::create([
                'tours_activities_id' => $data->id,  // Use the room_id from the saved Room instance
                'image_path' =>  $imageName,
            ]);
        }
    }


        $data->user_id = Auth::id(); 

        $data->save();
        if ($request->available_dates) {
            // Split the comma-separated string into an array of dates
            $dates = explode(',', $request->available_dates);
    
            // Loop through each date and insert it individually
            foreach ($dates as $date) {
                Tours_ActivitiesAvailability::create([
                    'tours_activities_id' => $data->id,
                    'available_date' => trim($date), // Insert each date one by one
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'Added successfully with available dates.');
    }

    

    public function view_tours()
    {
        $userId = Auth::id();

    // Fetch the rooms that belong to this user only
    $data = Tours_Activities::where('user_id', $userId)->get();

    $data = Tours_Activities::where('user_id', $userId)->with('availabilities')->get();

    // Pass the data to the view
    return view('admin.view_tours', compact('data'));
    }

    public function view_activities()
    {
        $userId = Auth::id();

    // Fetch the rooms that belong to this user only
    $data = Tours_Activities::where('user_id', $userId)->get();

    $data = Tours_Activities::where('user_id', $userId)->with('availabilities')->get();

    // Pass the data to the view
    return view('admin.view_activities', compact('data'));
    }

    public function add_user()
    {
        return view('superadmin.add_user');
    }

    public function view_account()
    {
        $data = User::all();

        return view('superadmin.view_account', compact('data'));
    }

    public function room_delete($id)
    {
        $data = Room::find($id);

        $data->delete();

        return redirect()->back();
    }

    public function activity_delete($id)
    {
        $data = Tours_Activities::find($id);

        $data->delete();

        return redirect()->back();
    }

    public function tour_delete($id)
    {
        $data = Tours_Activities::find($id);

        $data->delete();

        return redirect()->back();
    }

    public function update_room($id)
    {
        $data = Room::find($id);
        $contacts = json_decode($data->contacts, true); // Decode the JSON contacts field into an array
        $offers = json_decode($data->offers); // Decode the offers JSON
        $userId = Auth::id();

    // Fetch the room that belongs to the authenticated user, with its available dates
    $room = Room::where('id', $id)->where('user_id', $userId)->with('availabilities')->first();

    // Check if the room exists and belongs to the authenticated user
    if (!$room) {
        return redirect()->back()->with('error', 'Room not found');
    }

    // Format the available dates as a comma-separated string for Flatpickr
    $availableDates = $room->availabilities->pluck('available_date')->implode(',');
    $contacts = $contacts ?? [];
        return view('admin.update_room',compact('data','room', 'availableDates', 'offers', 'contacts'));

        
    }

    public function update_activities($id)
    {
        $data = Tours_Activities::find($id);
        $contacts = json_decode($data->contacts, true); // Decode the JSON contacts field into an array
        $offers = json_decode($data->offers); // Decode the offers JSON

        $userId = Auth::id();

    // Fetch the room that belongs to the authenticated user, with its available dates
    $activity = Tours_Activities::where('id', $id)->where('user_id', $userId)->with('availabilities')->first();

    // Check if the room exists and belongs to the authenticated user
    if (!$activity) {
        return redirect()->back()->with('error', 'Activity not found');
    }

    // Format the available dates as a comma-separated string for Flatpickr
    $availableDates = $activity->availabilities->pluck('available_date')->implode(',');

        return view('admin.update_activities',compact('data', 'availableDates', 'offers', 'contacts'));

        
    }

    public function update_tours($id)
    {
        $data = Tours_Activities::find($id);
        $contacts = json_decode($data->contacts, true); // Decode the JSON contacts field into an array

        $offers = json_decode($data->offers); // Decode the offers JSON

        $userId = Auth::id();

    // Fetch the room that belongs to the authenticated user, with its available dates
    $tour = Tours_Activities::where('id', $id)->where('user_id', $userId)->with('availabilities')->first();

    // Check if the room exists and belongs to the authenticated user
    if (!$tour) {
        return redirect()->back()->with('error', 'Tour not found');
    }

    // Format the available dates as a comma-separated string for Flatpickr
    $availableDates = $tour->availabilities->pluck('available_date')->implode(',');

        return view('admin.update_tours',compact('data', 'availableDates', 'offers', ));

        
    }

    public function book_room(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'size' => 'required|integer|min:1',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date',
            'arrival_time' => 'required|date_format:H:i',
            'id_image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Validate image file
        ]);

        // Handle the image upload
        if ($request->hasFile('id_image')) {
            $imagePath = $request->file('id_image')->store('id_images', 'public');
        }

        // Create the booking record with the ticket_id generated automatically
        Booking::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'size' => $request->size,
            'checkin_date' => $request->checkin_date,
            'checkout_date' => $request->checkout_date,
            'arrival_time' => $request->arrival_time,
            'id_image' => isset($imagePath) ? $imagePath : null,
        ]);

        // Redirect with a success message
        // app/Http/Controllers/BookingController.php

return redirect()->back()->with('success', 'Your booking has been confirmed! Your ticket ID is: ' . $booking->ticket_id);

    }
    public function toggleStatus($id)
    {
        $room = Room::find($id);
    
        if (!$room) {
            return redirect()->back()->with('error', 'Room not found.');
        }
    
        // Toggle the status
        $room->status = $room->status === 'In Service' ? 'Out of Service' : 'In Service';
        $room->save();
    
        return redirect()->back()->with('success', 'Room status updated successfully.');
    }

    public function toggleStatusOther($id)
    {
        $data = Tours_Activities::find($id);
    
        if (!$data) {
            return redirect()->back()->with('error', 'Not found.');
        }
    
        // Toggle the status
        $data->status = $data->status === 'In Service' ? 'Out of Service' : 'In Service';
        $data->save();
    
        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function details_room($room_id)
{
    if (!Room::where('id', $room_id)->exists()) {
        dd("Room with ID $room_id not found.");
    }

    $room = Room::where('id', $room_id)
                ->with('availabilities')
                ->firstOrFail();

    return view('admin.details_room', compact('room'));
}

public function details_tour($tour_activity_id)
{
    if (!Tours_Activities::where('id', $tour_activity_id)->exists()) {
        dd("Room with ID $tour_activity_id not found.");
    }

    $data = Tours_Activities::where('id', $tour_activity_id)
                ->with('availabilities')
                ->firstOrFail();

    return view('admin.details_tour', compact('data'));
}

public function details_activity($tour_activity_id)
{
    if (!Tours_Activities::where('id', $tour_activity_id)->exists()) {
        dd("Activity with ID $tour_activity_id not found.");
    }

    $data = Tours_Activities::where('id', $tour_activity_id)
                ->with('availabilities')
                ->firstOrFail();

    return view('admin.details_activity', compact('data'));
}
} 

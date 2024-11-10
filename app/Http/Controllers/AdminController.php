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
                return view('home.index',compact('room'));
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
        return view('home.index',compact('room'));
    }

    public function about()
    {
        return view('home.aboutpage');
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
        $data->contacts = $request->contacts;
        $data->wifi = $request->wifi;
        $data->room_type = $request->type;
        $data->user_id = Auth::id();
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

    // Fetch the rooms that belong to this user only
    $data = Room::where('user_id', $userId)->get();

    $data = Room::where('user_id', $userId)->with('availabilities')->get();

    // Pass the data to the view
    return view('admin.view_room', compact('data'));
    }

    public function edit_room(Request $request, $id)
    {
        $data = Room::find($id);

        $data->room_title = $request->title;

        $data->description = $request->description;

        $data->price = $request->price;

        $data->wifi = $request->wifi;

        $data->room_type = $request->type;

        $data->save();

        if ($request->hasFile('image')) {
            $room_image = $request->file('image');
            $imagename = time() . '.' . $room_image->getClientOriginalExtension();
            $room_image->move(public_path('room'), $imagename);
            $data->room_image =  $imagename;
            $data->save(); // Save the main room image path
        }

        // Update additional images
    if ($request->hasFile('additionalImages')) {
        // Delete existing additional images
        $existingImages = RoomImage::where('room_id', $data->id)->get();
        foreach ($existingImages as $existingImage) {
            if (file_exists(public_path('room_images/' . $existingImage->image_path))) {
                unlink(public_path('room_images/' . $existingImage->image_path));
            }
            $existingImage->delete();
        }

        // Save new additional images
        foreach ($request->file('additionalImages') as $additionalImage) {
            $imageName = time() . '_' . $additionalImage->getClientOriginalName();
            $additionalImage->move(public_path('room_images'), $imageName);
            RoomImage::create([
                'room_id' => $data->id,
                'image_path' => $imageName,
            ]);
        }
    }
    $data->user_id = Auth::id(); 
$data->save();

if ($request->available_dates) {
    // Remove existing available dates for the room
    RoomAvailability::where('room_id', $data->id)->delete();

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
    return redirect()->back()->with('success', 'Room updated successfully, and images have been replaced.');
}

public function edit_activity(Request $request, $id)
    {
        $data = Tours_Activities::find($id);

        $data->title = $request->title;

        $data->description = $request->description;

        $data->price = $request->price;

        $data->location = $request->location;
        $data->contacts = $request->contacts;

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

        $data->price = $request->price;

        $data->location = $request->location;
        $data->contacts = $request->contacts;

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
        $data->contacts = $request->contacts;
        $data->type = $request->type;
        $data->user_id = Auth::id();
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
        $userId = Auth::id();

    // Fetch the room that belongs to the authenticated user, with its available dates
    $room = Room::where('id', $id)->where('user_id', $userId)->with('availabilities')->first();

    // Check if the room exists and belongs to the authenticated user
    if (!$room) {
        return redirect()->back()->with('error', 'Room not found');
    }

    // Format the available dates as a comma-separated string for Flatpickr
    $availableDates = $room->availabilities->pluck('available_date')->implode(',');

        return view('admin.update_room',compact('data','room', 'availableDates'));

        
    }

    public function update_activities($id)
    {
        $data = Tours_Activities::find($id);
        $userId = Auth::id();

    // Fetch the room that belongs to the authenticated user, with its available dates
    $activity = Tours_Activities::where('id', $id)->where('user_id', $userId)->with('availabilities')->first();

    // Check if the room exists and belongs to the authenticated user
    if (!$activity) {
        return redirect()->back()->with('error', 'Activity not found');
    }

    // Format the available dates as a comma-separated string for Flatpickr
    $availableDates = $activity->availabilities->pluck('available_date')->implode(',');

        return view('admin.update_activities',compact('data', 'availableDates'));

        
    }

    public function update_tours($id)
    {
        $data = Tours_Activities::find($id);
        $userId = Auth::id();

    // Fetch the room that belongs to the authenticated user, with its available dates
    $tour = Tours_Activities::where('id', $id)->where('user_id', $userId)->with('availabilities')->first();

    // Check if the room exists and belongs to the authenticated user
    if (!$tour) {
        return redirect()->back()->with('error', 'Tour not found');
    }

    // Format the available dates as a comma-separated string for Flatpickr
    $availableDates = $tour->availabilities->pluck('available_date')->implode(',');

        return view('admin.update_tours',compact('data', 'availableDates'));

        
    }
} 

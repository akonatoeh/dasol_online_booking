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
use Illuminate\Support\Facades\DB;



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

            else if ($usertype == 'superadmin') {
                // Fetch totals for all bookings
                $totalBooking = Booking::whereIn('status', ['Ongoing', 'Finished'])
                    ->selectRaw('SUM(size + size2 + foreigners) as total')
                    ->value('total') ?? 0; // Default to 0 if null
            
                $totalBookingOthers = BookingOther::whereIn('status', ['Ongoing', 'Finished'])
                    ->selectRaw('SUM(size + size2 + foreigners) as total')
                    ->value('total') ?? 0; // Default to 0 if null
            
                // Calculate the grand total
                $totalTourists = $totalBooking + $totalBookingOthers;
            
                // Prepare data for the chart (all bookings)
                $bookingData = Booking::selectRaw("DATE_FORMAT(created_at, '%M %Y') as month_year, COUNT(*) as total")
                    ->groupBy('month_year')
                    ->get();
            
                // Pass the data to the view
                return view('superadmin.superadmin', compact('totalBooking', 'totalBookingOthers', 'totalTourists', 'bookingData'));
            }

            else if ($usertype == 'admin')
            {   
                $userId = Auth::id(); // Get the logged-in user's ID

                $totalBooking = Booking::whereIn('status', ['Ongoing', 'Finished'])
                    ->selectRaw('SUM(size + size2 + foreigners) as total')
                    ->value('total') ?? 0; // Default to 0 if null
            
                $totalBookingOthers = BookingOther::whereIn('status', ['Ongoing', 'Finished'])
                    ->selectRaw('SUM(size + size2 + foreigners) as total')
                    ->value('total') ?? 0; // Default to 0 if null
            
                // Calculate the grand total
                $totalTourists = $totalBooking + $totalBookingOthers;
            
                // Prepare data for the chart (all bookings)
                $bookingData = Booking::selectRaw("DATE_FORMAT(created_at, '%M %Y') as month_year, COUNT(*) as total")
                    ->groupBy('month_year')
                    ->get();
            
                // Pass the data to the view
                return view('admin.index', compact('totalBooking', 'totalBookingOthers', 'totalTourists', 'bookingData'));
            }

            else 
            {
                return redirect()->back();
            }
        }
    }

    public function admin_home()
    {
        $userId = Auth::id(); // Get the logged-in user's ID

                $totalBooking = Booking::whereIn('status', ['Ongoing', 'Finished'])
                    ->selectRaw('SUM(size + size2 + foreigners) as total')
                    ->value('total') ?? 0; // Default to 0 if null
            
                $totalBookingOthers = BookingOther::whereIn('status', ['Ongoing', 'Finished'])
                    ->selectRaw('SUM(size + size2 + foreigners) as total')
                    ->value('total') ?? 0; // Default to 0 if null
            
                // Calculate the grand total
                $totalTourists = $totalBooking + $totalBookingOthers;
            
                // Prepare data for the chart (all bookings)
                $bookingData = Booking::selectRaw("DATE_FORMAT(created_at, '%M %Y') as month_year, COUNT(*) as total")
                    ->groupBy('month_year')
                    ->get();
            
                // Pass the data to the view
                return view('admin.index', compact('totalBooking', 'totalBookingOthers', 'totalTourists', 'bookingData'));
    }

    public function superadmin_home()
{
    // Fetch totals from the bookings table
    $totalBooking = Booking::whereIn('status', ['Ongoing', 'Finished'])
        ->selectRaw('SUM(size + size2 + foreigners) as total')
        ->value('total');

    // Fetch totals from the booking_others table
    $totalBookingOthers = BookingOther::whereIn('status', ['Ongoing', 'Finished'])
        ->selectRaw('SUM(size + size2 + foreigners) as total')
        ->value('total');

    // Ensure null values are handled
    $totalBooking = $totalBooking ?? 0;
    $totalBookingOthers = $totalBookingOthers ?? 0;

    // Calculate the grand total
    $totalTourists = $totalBooking + $totalBookingOthers;

    // Prepare data for the chart
    $bookingData = Booking::selectRaw("DATE_FORMAT(created_at, '%M %Y') as month_year, COUNT(*) as total")
        ->groupBy('month_year')
        ->get();

    // Pass all variables to the view
    return view('superadmin.superadmin', compact('totalBooking', 'totalBookingOthers', 'totalTourists', 'bookingData'));
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

    public function room_page(Request $request)
    {
        $selectedType = $request->get('type', '');

    // Fetch room types with only Regular, Premium, and Deluxe
    $types = Room::select('room_type')
        ->distinct()
        ->whereIn('room_type', ['Regular', 'Premium', 'Deluxe'])
        ->get();

    // Fetch rooms based on the selected type, or all rooms if no filter
    $rooms = Room::when($selectedType, function ($query) use ($selectedType) {
        return $query->where('room_type', $selectedType);
    })->paginate(8); // Adjust per page as needed

    return view('home.roompage', compact('rooms', 'types', 'selectedType'));
    }

    public function tours_activities_page(Request $request)
    {   
        // Fetch unique types from booking_others table
    $types = DB::table('tours__activities')->select('type')->distinct()->get();

    // Get the selected type from the request
    $selectedType = $request->input('type');

    // Fetch data filtered by type (if selected) or fetch all
    $datas = DB::table('tours__activities')
        ->when($selectedType, function ($query, $selectedType) {
            return $query->where('type', $selectedType);
        })
        ->paginate(8); // Paginate the results

    // Pass types and datas to the view
    return view('home.tours_activitiespage', compact('datas', 'types', 'selectedType'));
    }

    public function  report_generation()
    {
        return view('admin.report_generation');
    }

   
    public function create_room()
    {
        return view('admin.create_room');
    }

    public function add_room(Request $request)
    {

        $user = Auth::user();

        $data = new Room();
        $data->room_title = $request->title;
        $data->description = $request->description;
        $data->new_location = $request->location;
        $data->price = $request->price;
        $data->max_adults = $request->max_adults;
        $data->max_children = $request->max_children;
        $data->available_rooms = $request->available_rooms;
        $data->room_type = $request->type;
        
        $data->business_name = $user->business_name;
        $data->user_id = Auth::id();
        $data->status = $request->status ?? 'In Service';

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
    // Get the authenticated user's ID
    $userId = Auth::id();

    // Fetch the rooms that belong to this user and load the availabilities relationship
    $data = Room::where('user_id', $userId)->with('availabilities')
    ->latest() // Order by most recent bookings
    ->get();
    // Pass the rooms collection to the view
    return view('admin.view_room', compact('data'));
}


    public function edit_room(Request $request, $id)
{

    $user = Auth::user();
    $data = Room::find($id);

    // Update basic room information
    $data->room_title = $request->room_title;
    $data->description = $request->description;
    $data->max_adults = $request->input('max_adults');
    $data->max_children = $request->input('max_children');
    $data->price = $request->price;
    $data->new_location = $request->location;

    $data->room_type = $request->type;
    $data->offers = json_encode(json_decode($request->offers, true)); // Ensure it's JSON-encoded
    $data->contacts = json_encode(json_decode($request->contacts, true));
    $data->user_id = Auth::id(); 

    $data->business_name = $user->business_name;

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
        $user = Auth::user();

        $data = Tours_Activities::find($id);

        $data->title = $request->title;

        $data->description = $request->description;
        $data->max_adults = $request->input('max_adults');
        $data->max_children = $request->input('max_children');

        $data->price = $request->price;

        $data->location = $request->location;

        $data->offers = json_encode(json_decode($request->offers, true)); // Ensure it's JSON-encoded

        $data->contacts = json_encode(json_decode($request->contacts, true));

        $data->business_name = $user->business_name;

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

        $user = Auth::user();

        $data = Tours_Activities::find($id);

        $data->title = $request->title;

        $data->description = $request->description;
        $data->max_adults = $request->input('max_adults');
        $data->max_children = $request->input('max_children');
        $data->price = $request->price;

        $data->location = $request->location;

        $data->offers = json_encode(json_decode($request->offers, true)); // Ensure it's JSON-encoded

        $data->contacts = json_encode(json_decode($request->contacts, true));

        $data->business_name = $user->business_name;

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
        $user = Auth::user();

        $data = new Tours_Activities();
        $data->title = $request->title;
        $data->description = $request->description;
        $data->location = $request->location;
        $data->price = $request->price;
        $data->max_adults = $request->max_adults;
        $data->max_children = $request->max_children;
        $data->type = $request->type;
        $data->user_id = Auth::id();
        $data->status = $request->status ?? 'In Service';

        $data->offers = json_encode(json_decode($request->offers, true)); // Ensure it's JSON-encoded

        $data->contacts = json_encode(json_decode($request->contacts, true));
        $data->business_name = $user->business_name;

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
        

    $data = Tours_Activities::where('user_id', $userId)->with('availabilities')
    ->latest() // Order by most recent bookings
    ->get();
    // Pass the data to the view
    return view('admin.view_tours', compact('data'));
    }

    public function view_activities()
    {
        $userId = Auth::id();

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

    public function business_owners()
    {
        $data = User::all();

        return view('superadmin.business_owner', compact('data'));
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

    public function update_tours($id)
    {
        $data = Tours_Activities::find($id);
        $contacts = json_decode($data->contacts, true); // Assuming contacts are stored as JSON
    $offers = json_decode($data->offers, true); // Assuming offers are stored as JSON
        
        $userId = Auth::id();

    // Fetch the room that belongs to the authenticated user, with its available dates
    $tour = Tours_Activities::where('id', $id)->where('user_id', $userId)->with('availabilities')->first();

    // Check if the room exists and belongs to the authenticated user
    if (!$tour) {
        return redirect()->back()->with('error', 'Service not found');
    }

    // Format the available dates as a comma-separated string for Flatpickr
    $availableDates = $tour->availabilities->pluck('available_date')->implode(',');

        return view('admin.update_tours',compact('tour', 'data', 'availableDates', 'offers', 'contacts'));

        
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

    // Load room details with availabilities
    $room = Room::where('id', $room_id)
                ->with('availabilities') // Ensure relationship is loaded
                ->firstOrFail();

    // Extract unique years from availabilities
    $years = $room->availabilities
                  ->map(function ($availability) {
                      return date('Y', strtotime($availability->available_date));
                  })
                  ->unique()
                  ->sort()
                  ->values()
                  ->toArray();

    return view('admin.details_room', compact('room', 'years'));
}


public function details_tour($tour_activity_id)
{
    if (!Tours_Activities::where('id', $tour_activity_id)->exists()) {
        dd("Room with ID $tour_activity_id not found.");
    }

    $data = Tours_Activities::where('id', $tour_activity_id)
                ->with('availabilities')
                ->firstOrFail();

                $years = $data->availabilities
                  ->map(function ($availability) {
                      return date('Y', strtotime($availability->available_date));
                  })
                  ->unique()
                  ->sort()
                  ->values()
                  ->toArray();

    return view('admin.details_tour', compact('data', 'years'));
}

public function details_activity($tour_activity_id)
{
    if (!Tours_Activities::where('id', $tour_activity_id)->exists()) {
        dd("Activity with ID $tour_activity_id not found.");
    }

    $data = Tours_Activities::where('id', $tour_activity_id)
                ->with('availabilities')
                ->firstOrFail();

                $data = Tours_Activities::where('id', $tour_activity_id)
                ->with('availabilities')
                ->firstOrFail();

                $years = $data->availabilities
                  ->map(function ($availability) {
                      return date('Y', strtotime($availability->available_date));
                  })
                  ->unique()
                  ->sort()
                  ->values()
                  ->toArray();

    return view('admin.details_activity', compact('data', 'years'));
}

public function view_roomBookings()
{
    $bookedRooms = Booking::with('room') // Load room relationship
        ->latest() // Order by most recent bookings
        ->get();

    return view('admin.bookings_room', compact('bookedRooms'));
}
public function view_tourBookings()
{
    $bookedRooms = BookingOther::with('data') // Load room relationship
        ->latest() // Order by most recent bookings
        ->get();

    return view('admin.bookings_tour', compact('bookedRooms'));
}
public function view_activityBookings()
{
    $bookedRooms = BookingOther::with('data') // Load room relationship
        ->latest() // Order by most recent bookings
        ->get();

    return view('admin.bookings_activity', compact('bookedRooms'));
}



public function reviews()
{
    // Fetch reviews for rooms
    $roomReviews = DB::table('reviews')
        ->join('bookings', 'reviews.booking_id', '=', 'bookings.id')
        ->join('rooms', 'reviews.room_id', '=', 'rooms.id')
        ->select(
            'reviews.id',
            'bookings.ticket as booking_ticket',
            DB::raw("'Room' as type"), // Add "Room" as the type
            'rooms.room_title as item_name',
            'rooms.room_type as item_type',
            'reviews.rating',
            'reviews.comment',
            'reviews.created_at'
        );

    // Fetch reviews for other services
    $serviceReviews = DB::table('reviewsOther')
        ->join('booking_others', 'reviewsOther.booking_other_id', '=', 'booking_others.id')
        ->join('tours__activities', 'reviewsOther.service_id', '=', 'tours__activities.id')
        ->select(
            'reviewsOther.id',
            'booking_others.ticket as booking_ticket',
            DB::raw("'Service' as type"), // Add "Service" as the type
            'tours__activities.title as item_name',
            'tours__activities.description as item_type',
            'reviewsOther.rating',
            'reviewsOther.comment',
            'reviewsOther.created_at'
        );

    // Use union to combine both queries
    $allReviews = $roomReviews->union($serviceReviews)
        ->orderBy('created_at', 'desc') // Order by `created_at`
        ->paginate(10); // Paginate the results

    return view('admin.reviews_page', compact('allReviews'));
}

} 

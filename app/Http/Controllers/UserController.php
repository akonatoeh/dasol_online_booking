<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomAvailability;
use App\Models\Tours_ActivitiesAvailability;
use App\Models\User;
use App\Models\Booking;
use App\Models\BookingOther;
use App\Models\Category;
use App\Models\Announcement;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Add this line

class UserController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate and create the user
            User::create([
                'name' => $request->name,
                'business_name' => $request->business_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'location' => $request->location,
                'usertype' => $request->usertype,
                'password' => Hash::make($request->password), // Ensure password is hashed
            ]);
    
            return redirect()->back()->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'User could not be created.');
        }
    }


public function messages()
{
    return view('superadmin.messages');
}

public function announcements()
{
    $announcements = Announcement::all();
    return view('superadmin.announcements', compact('announcements'));
}
public function createAnnouncement()
{
    return view('superadmin.announcements.create');
}

public function storeAnnouncement(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'expiry_date' => 'nullable|date',
    ]);

    Announcement::create([
        'title' => $request->title,
        'content' => $request->content,
        'author' => auth()->user()->name,
        'expiry_date' => $request->expiry_date,
    ]);

    return redirect()->route('announcements.index')->with('success', 'Announcement created successfully.');
}


public function add_category(Request $request)
{
    $request->validate([
        'category_name' => 'required|string|max:255|unique:categories,name',
    ]);

    // Save the category
    Category::create([
        'name' => $request->category_name,
    ]);

    return redirect()->back()->with('success', 'Category added successfully!');
}

public function indexAnouncement()
    {
        $announcements = Announcement::all();
        return view('admin.announcements.index', compact('announcements'));
    }

    public function createAnouncement()
    {
        return view('admin.announcements.create');
    }

    public function storeAnouncement(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'expiry_date' => 'nullable|date',
        ]);

        Announcement::create([
            'title' => $request->title,
            'content' => $request->content,
            'author' => auth()->user()->name,
            'expiry_date' => $request->expiry_date,
        ]);

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully.');
    }

    public function destroyAnouncement(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}

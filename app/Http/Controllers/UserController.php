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
use Illuminate\Support\Facades\Auth;


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

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);
    
        $category = Category::findOrFail($id);
        $category->name = $request->category_name;
        $category->save();
    
        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    public function deleteCategory($id)
{
    $category = Category::findOrFail($id); // Find the category by ID
    $category->delete(); // Delete the category

    return redirect()->back()->with('success', 'Category deleted successfully!');
}
public function messages()
{
    return view('superadmin.messages');
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

public function announcements()
{
    $announcements = Announcement::all();
    return view('superadmin.announcements', compact('announcements'));
}
public function createAnnouncement()
{
    return view('superadmin.announcements.create');
}

// Store the announcement in the database
public function storeAnnouncement(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'target_audience' => 'required|in:users,admin',
        'expiry_date' => 'nullable|date|after_or_equal:today',
    ]);

    Announcement::create([
        'title' => $request->title,
        'content' => $request->content,
        'target_audience' => $request->target_audience,
        'author' => Auth::user()->name,
        'expiry_date' => $request->expiry_date,
    ]);

    return redirect()->route('superadmin.announcements')->with('success', 'Announcement created successfully!');
}

// List all announcements (SuperAdmin view)
public function indexAnnouncement()
{
    $announcements = Announcement::orderBy('created_at', 'desc')->get();
    return view('superadmin.announcements', compact('announcements'));
}

// Delete an announcement
public function destroyAnnouncement($id)
{
    $announcement = Announcement::findOrFail($id);
    $announcement->delete();

    return redirect()->route('superadmin.announcements')->with('success', 'Announcement deleted successfully!');
}

public function showAnnouncements()
{
    $announcements = Announcement::where(function ($query) {
        $query->whereNull('expiry_date') // Include announcements without expiry
              ->orWhere('expiry_date', '>=', now()); // Include announcements not yet expired
    })->orderBy('created_at', 'desc')->get();

    return view('user.announcements', compact('announcements'));
}

public function edit($id)
{
    $announcement = Announcement::findOrFail($id);
    return view('superadmin.edit-announcement', compact('announcement'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'expiry_date' => 'nullable|date|after_or_equal:today',
    ]);

    $announcement = Announcement::findOrFail($id);
    $announcement->update([
        'title' => $request->title,
        'content' => $request->content,
        'expiry_date' => $request->expiry_date,
    ]);

    return redirect()->route('superadmin.announcements')->with('success', 'Announcement updated successfully!');
}
}

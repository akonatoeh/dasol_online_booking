<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomAvailability;
use App\Models\Tours_ActivitiesAvailability;
use App\Models\User;
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
                'usertype' => $request->usertype,
                'password' => Hash::make($request->password), // Ensure password is hashed
            ]);
    
            return redirect()->back()->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'User could not be created.');
        }
    }




}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomAvailability;
use App\Models\Tours_ActivitiesAvailability;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate and create the user
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'usertype' => $request->usertype,
                'password' => $request->password,
            ]);
    
            return redirect()->back()->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'User could not be created.');
        }
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class OwnerController extends Controller
{ 
    public function index()
    {
        $owner = Auth::user();
        $properties = $owner->properties;
       
        $token = $owner->tokens()->first()->token ?? '';
        $servicesCount = $properties->sum(function ($property) {
            return $property->services->count();
        });
    
        $guidesCount = $properties->sum(function ($property) {
            return $property->guides->count();
        });
    
        $businessCount = $properties->sum(function ($property) {
            return $property->localBusinesses->count();
        });
    
        $faqsCount = $properties->sum(function ($property) {
            return $property->faqs->count();
        });
        return view('owner.dashboard', compact('owner', 'properties', 'servicesCount', 'guidesCount', 'businessCount', 'faqsCount','token'));
    }

    public function edit($id)
    {
        // Only allow owners to edit their profile
        if (Auth::id() != $id && Auth::user()->role != 'owner') {
            abort(403);
        }
        $user = User::findOrFail($id);
        // Make sure to use a dedicated view for owners if necessary
        return view('owner.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        
        // Ensure the user doing the update is the owner or has the right to do so
        if (Auth::id() != $id && Auth::user()->role != 'owner') {
            abort(403);
        }
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'owner_image' => 'nullable|file|mimes:jpeg,png,jpg',
            // Validate other fields if necessary
        ]);
        $user = User::findOrFail($id);
        // Inside your update method
        if ($request->hasFile('owner_image')) {
            // First, we delete the old image if it exists
            if ($user->owner_image) {
                $deleteResult = Storage::disk('public')->delete($user->owner_image);
            }

            // Now, let's define the new path
            $path = "owners/{$id}";

            // Store the image and get the path
            $filePath = $request->file('owner_image')->store($path, 'public');
           
            $user->owner_image = $filePath;
        }


       
        $user->update($validatedData);
        // Redirect to the owner's edit page, not the generic user edit
        return redirect()->route('owner.edit', $id)->with('success', 'Profile updated successfully');
    }

    public function renewToken(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        // Delete any existing token
        $user->tokens()->delete();

        // Create a new token
        $tokenResult = $user->createToken('OwnerID');
        $token = $tokenResult->accessToken;

        // Make sure you're returning a string token, not an object
        return response()->json(['token' => $token], 200);
    }


}
 
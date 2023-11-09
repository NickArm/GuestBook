<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class OwnerController extends Controller
{
    public function index()
    {
        $owner = Auth::user();
        $properties = $owner->properties;
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
        return view('owner.dashboard', compact('owner', 'properties', 'servicesCount', 'guidesCount', 'businessCount', 'faqsCount'));
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
            // Validate other fields if necessary
        ]);
        $user = User::findOrFail($id);
        $user->update($validatedData);
        // Redirect to the owner's edit page, not the generic user edit
        return redirect()->route('owner.edit', $id)->with('success', 'Profile updated successfully');
    }


}
 
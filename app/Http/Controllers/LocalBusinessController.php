<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\LocalBusiness;
use App\Models\LocalBusinessCategory;
use Illuminate\Support\Facades\Storage;

class LocalBusinessController extends Controller
{
    public function create(Property $property) {
        $categories = LocalBusinessCategory::all();
        return view('property.local_business.create', compact('property', 'categories'));
    }

    public function store(Request $request, Property $property) {
        $data = $request->validate([
            'category_id' => 'required|exists:local_business_categories,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif',
            'google_map' => 'nullable|string',
            'directions_url' => 'nullable|string',
            'external_url' => 'nullable|string'
        ]);

        $ownerId = $property->owner->id; // Assuming the property model has a relationship to its owner

        if ($request->hasFile('image')) {
            $path = "public/owners/{$ownerId}/properties/{$property->id}/local-businesses/images";
            $data['image'] = $request->file('image')->store($path);
        }
        $data['property_id'] = $property->id;
        $property->localBusinesses()->create($data); // Assuming you have a relation named localBusinesses in the Property model

        return redirect()->route('property.show', $property)->with('success', 'Local business added successfully!');
    }

    public function edit(Property $property, LocalBusiness $localBusiness)
    {
        $categories = LocalBusinessCategory::all();
        return view('property.local_business.edit', compact('property', 'localBusiness', 'categories'));
    }

    public function update(Request $request, Property $property, LocalBusiness $localBusiness)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:local_business_categories,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif',
            'google_map' => 'nullable|string',
            'directions_url' => 'nullable|string',
            'external_url' => 'nullable|string'
        ]);

        $ownerId = $property->owner->id;

        if ($request->hasFile('image')) {
            if ($localBusiness->image) {
                Storage::disk('public')->delete(str_replace('public/', '', $localBusiness->image));
            }
            $path = "public/owners/{$ownerId}/properties/{$property->id}/local-businesses/images";
            $data['image'] = $request->file('image')->store($path);
        }

        $localBusiness->update($data);

        return redirect()->route('property.show', $property->id)->with('success', 'Local business updated successfully!');
    }

    public function destroy(Property $property, LocalBusiness $localBusiness)
    {
        if ($localBusiness->property_id !== $property->id) {
            return redirect()->back()->withErrors(['message' => 'Invalid local business for this property.']);
        }

        if ($localBusiness->image) {
            Storage::disk('public')->delete(str_replace('public/', '', $localBusiness->image));
        }

        $localBusiness->delete();

        return redirect()->route('property.show', $property)->with('status', 'Local business deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\GuideCategory;
use App\Models\PropertyGuide;
use Illuminate\Support\Facades\Storage;

class PropertyGuideController extends Controller
{
    public function create(Property $property) {
        $categories = GuideCategory::all();
        return view('property.guide.create', compact('property', 'categories'));
    }

    public function store(Request $request, Property $property) {
        $data = $request->validate([
            'title' => 'required|string',
            'category_id' => 'required|exists:guide_categories,id',
            'video_url' => 'nullable|string',
            'video_file' => 'nullable|file|mimes:mp4,avi,mkv',
            'content' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif'
        ]);

        $ownerId = $property->owner->id; // Assuming the property model has a relationship to its owner
    
        if($request->hasFile('video_file')) {
            $path = "/owners/{$ownerId}/properties/{$property->id}/guides/videos";
            $data['video_file'] = $request->file('video_file')->store($path);
            
        }

        if ($request->hasFile('image')) {
            $path = "/owners/{$property->owner_id}/properties/{$property->id}/guides/images";
            $data['image'] = $request->file('image')->store($path);
        }

        $property->guides()->create($data);

        return redirect()->route('property.show', $property);
    }

    public function edit(Property $property, PropertyGuide $guide)
    {
        $categories = GuideCategory::all();
        return view('property.guide.edit', compact('property', 'guide', 'categories'));
    }

    public function update(Request $request, PropertyService $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
            'definition' => 'required|json', // JSON validation for the dynamic form definition
        ]);

        $property = $service->property; // Assuming that a service belongs to a property
        $ownerId = $property->owner_id; // Adjust this according to your actual relationship/accessor

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($service->image) {
                Storage::disk('public')->delete("/owners/{$ownerId}/properties/{$property->id}/services/{$service->image}");
            }

            // Prepare the new path
            $path = "owners/{$ownerId}/properties/{$property->id}/services";

            // Save the new image and store the new filename
            $imageName = $request->image->store($path, 'public');
            $service->image = basename($imageName); // Save only the file name if that's your requirement
        }

        $service->name = $request->name;
        $service->description = $request->description;
        $service->definition = $request->definition;
        $service->property_id = $property->id; // Ensure this is the correct property ID

        $service->save();

        return redirect()->back()->with('success', 'Service updated successfully!');
    }


    public function destroy(Property $property, PropertyGuide $guide)
    {
        if($guide->property_id !== $property->id) {
            return redirect()->back()->withErrors(['message' => 'Invalid guide for this property.']);
        }

        if ($guide->video_file) {
            Storage::delete($guide->video_file);
        }

        if ($guide->image) {
            Storage::delete($guide->image);
        }

        $guide->delete();

        return redirect()->route('property.show', $property)->with('status', 'Guide deleted successfully!');
    }
}

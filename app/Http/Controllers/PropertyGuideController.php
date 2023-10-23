<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\GuideCategory;
use App\Models\PropertyGuide;

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
            'content' => 'nullable|string'
        ]);
    
        if($request->hasFile('video_file')) {
            $data['video_file'] = $request->file('video_file')->store('guides/videos');
        }
    
        $property->guides()->create($data);
        
        return redirect()->route('property.show', $property);
    }

    public function edit(Property $property, PropertyGuide $guide)
    {
        $categories = GuideCategory::all(); // Assuming you have a Category model
        return view('property.guide.edit', compact('property', 'guide', 'categories'));
    }

    public function update(Request $request, Property $property, PropertyGuide $guide)
    {
        // Validation
        $data = $request->validate([
            'title' => 'required|string',
            'category_id' => 'required|exists:guide_categories,id',
            'video_url' => 'nullable|string',
            'video_file' => 'nullable|file|mimes:mp4,avi,mkv',
            'content' => 'nullable|string'
        ]);
        
        $guide->update($data);
        
        return redirect()->route('property.show', $property->id)->with('success', 'Guide updated successfully!');
    }


    public function destroy(Property $property, PropertyGuide $guide)
    {
        // Ensure the guide belongs to the property to avoid accidental deletion
        if($guide->property_id !== $property->id) {
            return redirect()->back()->withErrors(['message' => 'Invalid guide for this property.']);
        }

        if ($guide->video_file) {
            Storage::delete($guide->video_file);
        }

        // Delete the guide
        $guide->delete();

        return redirect()->route('property.show', $property)->with('status', 'Guide deleted successfully!');
    }

    
}

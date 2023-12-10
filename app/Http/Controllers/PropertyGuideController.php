<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyGuide;
use App\Models\PropertyGuideCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyGuideController extends Controller
{
    public function create(Property $property)
    {
        $categories = PropertyGuideCategory::all();

        return view('property.guide.create', compact('property', 'categories'));
    }

    public function store(Request $request, Property $property)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'category_id' => 'required|exists:property_guide_categories,id',
            'video_url' => 'nullable|string',
            'video_file' => 'nullable|file|mimes:mp4,avi,mkv',
            'content' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif',
        ]);

        $ownerId = $property->owner->id; // Assuming the property model has a relationship to its owner

        if ($request->hasFile('video_file')) {
            $path = "/owners/{$ownerId}/properties/{$property->id}/guides/videos";
            $data['video_file'] = $request->file('video_file')->store($path);
        }

        if ($request->hasFile('image')) {
            $path = "/owners/{$property->owner_id}/properties/{$property->id}/guides/images";
            $data['image'] = $request->file('image')->store($path);
        }

        $property->guides()->create($data);

        return redirect('/property/'.$property->id.'/guides')->with('success', 'Guide Added successfully!');
    }

    public function edit(Property $property, PropertyGuide $guide)
    {
        $categories = PropertyGuideCategory::all();

        return view('property.guide.edit', compact('property', 'guide', 'categories'));
    }

    public function update(Request $request, Property $property, PropertyGuide $guide)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:property_guide_categories,id',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,avi,mkv',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $guide->title = $data['title'];
        $guide->category_id = $data['category_id'];
        $guide->video_url = $data['video_url'];
        $guide->content = $data['content'];

        if ($request->hasFile('image')) {
            if ($guide->image) {
                Storage::disk('public')->delete($guide->image);
            }

            $path = "owners/{$guide->property->owner_id}/properties/{$guide->property_id}/guides/images";
            $guide->image = $request->file('image')->store($path, 'public');
        }

        if ($request->hasFile('video_file')) {
            if ($guide->video_file) {
                Storage::disk('public')->delete($guide->video_file);
            }

            $path = "owners/{$guide->property->owner_id}/properties/{$guide->property_id}/guides/videos";
            $guide->video_file = $request->file('video_file')->store($path, 'public');
        }

        $guide->save();

        return redirect('/property/'.$guide->property_id.'/guides')->with('success', 'Guide Updated successfully!');
    }

    public function destroy(Property $property, PropertyGuide $guide)
    {
        if ($guide->property_id !== $property->id) {
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

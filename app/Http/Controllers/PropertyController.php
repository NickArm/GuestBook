<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\FAQCategory;
use App\Models\Property;
use App\Models\PropertySocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'property_title' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string',
                'address' => 'required|string',
                'country' => 'required|string',
                'google_map_url' => 'nullable|string',
                'check_in_time' => 'nullable',
                'check_out_time' => 'nullable',
                'property_rules' => 'nullable|string',
            ]);

            // Create a new property
            $property = new Property();
            $property->title = $validatedData['property_title'];
            $property->email = $validatedData['email'];
            $property->phone = $validatedData['phone'];
            $property->address = $validatedData['address'];
            $property->country = $validatedData['country'];
            $property->google_map_url = $validatedData['google_map_url'];
            $property->check_in_time = $validatedData['check_in_time'];
            $property->check_out_time = $validatedData['check_out_time'];
            // You may want to set owner_id based on the logged-in user
            $property->owner_id = auth()->id();

            // Save the property
            $property->save();

            return redirect()->route('property.index')->with('success', 'Property added successfully.');
        } catch (\Exception $e) {
            //\Log::error($e->getMessage());

            return redirect()->route('property.index')->with('error', 'There was a problem saving the property.');
        }
    }

    public function edit($id)
    {
        $property = Property::with('socialMediaProfiles')->findOrFail($id);
        // Load countries data from the JSON file
        $countriesJson = file_get_contents(public_path('countries.json'));
        $countries = json_decode($countriesJson, true);

        return view('property.edit', compact('property', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        // Validation

        $validatedData = $request->validate([
            'property_title' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'country' => 'required|string',
            'google_map_url' => 'nullable|string',
            'check_in_time' => 'nullable',
            'check_out_time' => 'nullable',
            'property_main_image' => 'nullable|file|mimes:jpeg,png,jpg',
        ]);
        // Clear existing social media profiles
        $property->socialMediaProfiles()->delete();

        // Check if social media data is provided
        if ($request->has(['social_media_name', 'profile_url'])) {
            foreach ($request->input('social_media_name') as $index => $name) {
                // Ensure the name and URL are not empty
                if ($name && $request->profile_url[$index]) {
                    PropertySocialMedia::create([
                        'property_id' => $id,
                        'social_media_name' => $name,
                        'profile_url' => $request->profile_url[$index],
                    ]);
                }
            }
        }

        // Manual update of the property's attributes
        $property->title = $validatedData['property_title'];
        $property->email = $validatedData['email'];
        $property->phone = $validatedData['phone'];
        $property->address = $validatedData['address'];
        $property->country = $validatedData['country'];
        $property->google_map_url = $validatedData['google_map_url'];
        $property->check_in_time = $validatedData['check_in_time'];
        $property->check_out_time = $validatedData['check_out_time'];
        // Check if an image was uploaded and validated before attempting to save it
        if (isset($validatedData['property_main_image'])) {
            $property->main_image = $validatedData['property_main_image'];
        }

        // Inside your update method
        if ($request->hasFile('property_main_image')) {
            // First, we delete the old image if it exists
            if ($property->main_image) {
                $deleteResult = Storage::disk('public')->delete($property->main_image);
            }

            // Now, let's define the new path
            $ownerId = $property->owner_id; // Assuming you have the owner_id field on your properties table
            $path = "owners/{$ownerId}/properties/{$property->id}";

            // Store the image and get the path
            $filePath = $request->file('property_main_image')->store($path, 'public');

            $property->main_image = $filePath;
        }

        $property->save();

        return redirect()->route('property.edit', $id)->with('success', 'Property updated successfully');
    }

    public function show($id, $tab = null)
    {
        $property = Property::with(['guides', 'localBusinesses', 'services', 'pages'])->find($id);
        $faq_categories = FAQCategory::all();
        $faqs = FAQ::where('property_id', $property->id)->get();
        $local_businesses = $property->localBusinesses;
        $pages = $property->pages;

        $tabContent = '';
        switch ($tab) {
            case 'guides':
                $tabContent = 'property.guide.show';
                break;
            case 'services':
                $tabContent = 'property.service.show';
                break;
            case 'faqs':
                $tabContent = 'property.faq.show';
                break;
            case 'local-recommendations':
                $tabContent = 'property.local_business.show';
                break;
            case 'pages':
                $tabContent = 'property.page.show';
                break;
            default:
                // Define a default tab content or leave as an empty string
                break;
        }

        return view('property.show', compact('property', 'faq_categories', 'faqs', 'local_businesses', 'pages', 'tabContent'));
    }

    public function index()
    {
        $countriesJson = file_get_contents(public_path('countries.json'));
        $countries = json_decode($countriesJson, true);

        return view('property.add', compact('countries'));
    }
}

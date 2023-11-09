<?php

namespace App\Http\Controllers;

use App\Models\PropertyService;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PropertyServiceController extends Controller
{
    // Display the create service form
    public function create(Property $property)
    {
        return view('property.service.create')->with([
            'property' => $property,
        ]);
    }


    public function store(Request $request, Property $property)
    {

        $request->validate([
            'property_service_name' => 'required|string|max:255',
            'property_service_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
            'definition' => 'required|json', // JSON validation for the dynamic form definition
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('images', $imageName);  // Store image in the "images" directory
        }

        PropertyService::create([
            'name' => $request->property_service_name,
            'description' => $request->property_service_description,
            'image' => isset($imageName) ? $imageName : null,
            'definition' => $request->definition,
            'property_id' => $property->id // linking the service to the property
        ]);

        return redirect()->route('service.create', ['property' => $property->id])->with('success', 'Service created successfully!');
    }

    public function edit(Property $property, PropertyService $service) // Laravel's route model binding will auto fetch service based on ID
    {
        // Check if service exists
        if (!$service) {
            return redirect()->back()->with('error', 'No service found to edit.');
        }

        // Pass the service to the edit view
        return view('property.service.edit', compact('property','service'));
    }

    public function update(Request $request, PropertyService $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
            'definition' => 'required|json', // JSON validation for the dynamic form definition
        ]);

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::delete('images/' . $service->image);
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('images', $imageName);

            $service->image = $imageName;
        }

        $service->name = $request->name;
        $service->description = $request->description;
        $service->definition = $request->definition;
        $service->property_id = $request->property_id; // Update the property_id field 

        $service->save();

        return redirect()->back()->with('success', 'Service updated successfully!');
    }

    public function destroy(Property $property, PropertyService $service)
    {
        // Check if the service belongs to the property
        if($service->property_id !== $property->id) {
            return redirect()->back()->withErrors(['message' => 'Invalid service for this property.']);
        }
        // Delete associated image if it exists
        if ($service->image) {
            Storage::delete($service->image);
        }
        $service->delete();
        return redirect()->route('property.show', $property)->with('status', 'Service deleted successfully!');
    }

    public function show(Property $property, PropertyService $service) // Laravel's route model binding will auto fetch both
    {
        // Pass the service and property to the show view
        return view('property.service.show', compact('service', 'property'));
    }
}

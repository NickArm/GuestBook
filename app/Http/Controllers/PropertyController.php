<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'propert_title' => 'required|string|max:255',
            'email'         => 'required|email',
            'phone'         => 'required|string',
            'address'       => 'required|string',
            'country'       => 'required|string',
            'google_maps'   => 'nullable|string',
            'checkin'       => 'nullable|date_format:H:i',
            'checkout'      => 'nullable|date_format:H:i',
            'property_rules'=> 'nullable|string',
        ]);

        // Create a new property
        $property = new Property();
        $property->title        = $validatedData['propert_title'];
        $property->email        = $validatedData['email'];
        $property->phone        = $validatedData['phone'];
        $property->address      = $validatedData['address'];
        $property->country      = $validatedData['country'];
        $property->google_map_url = $validatedData['google_maps'];
        $property->check_in_time = $validatedData['checkin'];
        $property->check_out_time= $validatedData['checkout'];
        $property->rules         = $validatedData['property_rules'];
        
        // You may want to set owner_id based on the logged-in user
        $property->owner_id = auth()->id();

        // Save the property
        $property->save();

        return redirect()->route('property.index')->with('success', 'Property added successfully.');
    }

    public function edit($id)
    {
        $property = Property::findOrFail($id);

        return view('property.edit', compact('property'));
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        // Validation
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'email'         => 'required|email',
            'phone'         => 'required|string',
            'address'       => 'required|string',
            'country'       => 'required|string',
            'google_map_url'   => 'nullable|string',
            'check_in_time'       => 'nullable|date_format:H:i',
            'check_out_time'      => 'nullable|date_format:H:i',
            'rules'=> 'nullable|string',
        ]);

        $property->title        = $validatedData['propert_title'];
        $property->email        = $validatedData['email'];
        $property->phone        = $validatedData['phone'];
        $property->address      = $validatedData['address'];
        $property->country      = $validatedData['country'];
        $property->google_map_url = $validatedData['google_maps'];
        $property->check_in_time = $validatedData['checkin'];
        $property->check_out_time= $validatedData['checkout'];
        $property->rules         = $validatedData['property_rules'];

         // Update the property's attributes
        $property->fill($validatedData);
        
        // Save the changes
        $property->save();
   
        return redirect()->route('property.edit', $id)->with('success', 'Property updated successfully');
    }


    public function show($id)
    {
        $property = Property::with('guides')->find($id);
        return view('property.show', compact('property'));
    }


    public function index()
    {
        return view('property.add');
    }
}

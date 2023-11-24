<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\FAQCategory;
use App\Models\FAQ;
use App\Models\LocalBusiness;
use App\Models\LocalBusinessCategory;
use App\Models\PropertyService;
use Illuminate\Support\Facades\Storage;

 

class PropertyController extends Controller
{
    public function store(Request $request)
    {
        
        // Validate the request data
        $validatedData = $request->validate([
            'property_title' => 'required|string|max:255',
            'email'         => 'required|email',
            'phone'         => 'required|string',
            'address'       => 'required|string',
            'country'       => 'required|string',
            'google_map_url'   => 'nullable|string',
            'check_in_time'       => 'nullable|date_format:H:i',
            'check_out_time'      => 'nullable|date_format:H:i',
            'property_rules'=> 'nullable|string',
        ]);
 
        // Create a new property
        $property = new Property();
        $property->title        = $validatedData['property_title'];
        $property->email        = $validatedData['email'];
        $property->phone        = $validatedData['phone'];
        $property->address      = $validatedData['address'];
        $property->country      = $validatedData['country'];
        $property->google_map_url = $validatedData['google_map_url'];
        $property->check_in_time = $validatedData['check_in_time'];
        $property->check_out_time= $validatedData['check_out_time'];
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
            'check_in_time' => 'nullable|date_format:H:i:s',
            'check_out_time' => 'nullable|date_format:H:i:s',
            'property_rules' => 'nullable|string',
            'property_main_image' => 'nullable|file|mimes:jpeg,png,jpg',
        ]);

        // Manual update of the property's attributes
        $property->title = $validatedData['property_title'];
        $property->email = $validatedData['email'];
        $property->phone = $validatedData['phone'];
        $property->address = $validatedData['address'];
        $property->country = $validatedData['country'];
        $property->google_map_url = $validatedData['google_map_url'];
        $property->check_in_time = $validatedData['check_in_time'];
        $property->check_out_time = $validatedData['check_out_time'];
        $property->rules = $validatedData['property_rules'];
        $property->main_image = $validatedData['property_main_image'];

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
        $property = Property::with(['guides', 'localBusinesses', 'services'])->find($id);
        $faq_categories = FAQCategory::all();
        $faqs = FAQ::where('property_id', $property->id)->get();
        $local_businesses = $property->localBusinesses;
        

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
            default:
                // Define a default tab content or leave as an empty string
                break;
        }


        return view('property.show', compact('property', 'faq_categories','faqs','local_businesses', 'tabContent'));
    }


    public function index()
    {
        return view('property.add');
    }



}

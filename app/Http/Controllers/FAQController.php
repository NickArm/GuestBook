<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQ;
use App\Models\FAQCategory; 

class FAQController extends Controller
{
    public function store(Request $request)
{
    // Validate the data
    $request->validate([
        'question' => 'required',
        'answer' => 'required',
        'category_id' => 'required',
        'property_id' => 'required|exists:properties,id' 
    ]);

    // Check if the user wants to create a new category
    if ($request->category_id === 'new' && $request->has('new_category_name')) {
        $category = FAQCategory::create(['name' => $request->new_category_name,'property_id' => $request->property_id]);
        $categoryId = $category->id;
    } else {
        $categoryId = $request->category_id;
    }

    // Create the new FAQ
    FAQ::create([
        'question' => $request->question,
        'answer' => $request->answer,
        'category_id' => $categoryId,
        'property_id' => $request->property_id
    ]);

    return redirect()->back()->with('success', 'FAQ added successfully!');
}

}

<?php

namespace App\Http\Controllers;

use App\Models\FAQCategory;
use Illuminate\Http\Request;

class FAQCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        FAQCategory::create([
            'name' => $request->input('name'),
            'property_id' => $request->property_id,
        ]);

        return redirect()->back()->with('success', 'FAQ Category added successfully!');
    }
}

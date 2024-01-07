<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\FAQCategory;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function store(Request $request)
    {
        // Validate the data
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'category_id' => 'required',
            'property_id' => 'required|exists:properties,id',
        ]);

        // Check if the user wants to create a new category
        if ($request->category_id === 'new' && $request->has('new_category_name')) {
            $category = FAQCategory::create(['name' => $request->new_category_name, 'property_id' => $request->property_id]);
            $categoryId = $category->id;
        } else {
            $categoryId = $request->category_id;
        }

        // Create the new FAQ
        FAQ::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'category_id' => $categoryId,
            'property_id' => $request->property_id,
        ]);

        return redirect()->back()->with('success', 'FAQ added successfully!');
    }

    public function edit($id)
    {
        $faq = FAQ::with('category')->findOrFail($id);
        $categories = FAQCategory::all();

        return response()->json([
            'faq' => $faq,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq = FAQ::findOrFail($id);
        $faq->update($data);

        return response()->json(['message' => 'FAQ updated successfully!']);
    }

    public function destroy($id)
    {
        $faq = FAQ::findOrFail($id);
        $faq->delete();

        // Return a JSON response for the AJAX request
        return response()->json(['success' => true, 'message' => 'FAQ deleted successfully!']);
    }
}

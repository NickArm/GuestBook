<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyPage;
use Illuminate\Http\Request;

class PropertyPageController extends Controller
{
    public function show(Property $property, PropertyPage $page)
    {
        return view('property.page.show', compact('page', 'property'));
    }

    public function create(Property $property)
    {
        return view('property.page.create')->with([
            'property' => $property,
        ]);
    }

    public function store(Request $request, Property $property)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $property->pages()->create($data);

        return redirect('/property/'.$property->id.'/pages')->with('success', 'Page Added successfully!');
    }

    public function edit(Property $property, PropertyPage $page)
    {
        return view('property.page.edit', compact('page', 'property'));
    }

    public function update(Request $request, Property $property, PropertyPage $page)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $page->update($data);

        return redirect('/property/'.$page->property_id.'/pages')->with('success', 'Page Updated successfully!');
    }

    public function destroy(Property $property, PropertyPage $page)
    {
        if ($page->property_id !== $property->id) {
            return redirect()->back()->withErrors(['message' => 'Invalid page for this property.']);
        }

        $page->delete();

        return redirect('/property/'.$page->property_id.'/pages')->with('success', 'Page Updated successfully!');
    }
}

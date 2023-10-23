<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OwnerController extends Controller
{
    public function index()
    {
        $owner = Auth::user();
        $properties = $owner->properties;
        //dd( $properties);
        return view('owner.dashboard', compact('owner','properties'));
    }
}
 
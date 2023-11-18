<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Property;
use App\Models\PropertyService;
use App\Models\PropertyGuide;
use App\Models\FAQ;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;


class OwnerApiController extends Controller
{
    public function getOwnerData($ownerId)
    {
        $owner = User::with([
            'properties' => function($query) {
                $query->with(['guides', 'faqs', 'services']);
            }
        ])->find($ownerId);

        if (!$owner) {
            return response()->json(['message' => 'Owner not found.'], 404);
        }

        return response()->json($owner, 200);
    }

    public function getOwnerProperties(Request $request)
    {
        $token = $request->bearerToken();
        $tokenID = explode('|', $token)[0] ?? null;
        $token = PersonalAccessToken::where('token', $tokenID)->first();
        $user = $token->tokenable;

        //$user = Auth::user(); // Sanctum authenticates the user based on the token
        $propertyId = $request->query('property_id');
        if ($propertyId) {
            // Fetch data for a specific property
            $property = $user->properties()->with(['guides', 'faqs', 'services'])
                ->where('id', $propertyId)
                ->first();
            if (!$property) {
                return response()->json(['message' => 'Property not found or not owned by the user'], 404);
            }
            return response()->json($property, 200);
        } else {
            $properties = $user->properties()->with(['guides', 'faqs', 'services'])->get();
            return response()->json($properties, 200);
        }
    }



}

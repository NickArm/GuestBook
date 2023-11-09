<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Property;
use App\Models\PropertyService;
use App\Models\PropertyGuide;
use App\Models\FAQ;

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

}

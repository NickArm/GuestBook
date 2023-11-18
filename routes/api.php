<?php
Auth::routes();
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\Auth\ApiAuthController;
use App\Http\Controllers\API\v1\OwnerApiController;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::prefix('v1')->group(function () {
    //Route::get('owner/{ownerId}/data', [App\Http\Controllers\API\v1\OwnerApiController::class, 'getOwnerData']);
    //Route::post('/login', [ApiAuthController::class, 'login']);
    Route::get('/data', [OwnerApiController::class, 'getOwnerProperties']);
});





// Route::get('/debug', function (Request $request) {
//     $token = $request->bearerToken();
//     $tokenID = explode('|', $token)[0] ?? null;
//     $token = PersonalAccessToken::where('token', $tokenID)->first();
//     $user = $token->tokenable;
//     if ($token) {

//         if ($user) {
            
//             return $user->id;
//         }
//     }

//     return response()->json(['error' => 'Token not found or invalid.'], 401);
// });

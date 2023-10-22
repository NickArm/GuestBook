<?php
Auth::routes();
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     if (auth()->check()) {
//         return redirect()->route('dashboard');
//     }
//     return view('welcome');
// });


// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// });


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::post('/admin/add-user', [AdminController::class, 'addUser'])->name('admin.addUser');

});

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'index'])->name('owner.dashboard');
});



Route::post('logout', [LoginController::class, 'logout'])->name('logout');

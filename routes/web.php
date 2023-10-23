<?php
Auth::routes();
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyGuideController;
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
    Route::get('/property/new', [PropertyController::class, 'index'])->name('property.index');
    Route::post('/property/store', [PropertyController::class, 'store'])->name('property.store');
    Route::get('/property/{id}', [PropertyController::class, 'show'])->name('property.show');
    Route::get('/property/{id}/edit', [PropertyController::class, 'edit'])->name('property.edit');
    Route::put('/property/{id}', [PropertyController::class, 'update'])->name('property.update');
    // Property's Guides Routes
    Route::get('property/{property}/guide/create', [PropertyGuideController::class, 'create'])->name('guide.create');
    Route::post('property/{property}/guide', [PropertyGuideController::class, 'store'])->name('guide.store');
    Route::get('property/{property}/guide/{guide}/edit', [PropertyGuideController::class, 'edit'])->name('guide.edit');
    Route::put('property/{property}/guide/{guide}', [PropertyGuideController::class, 'update'])->name('guide.update');
    Route::delete('property/{property}/guide/{guide}',  [PropertyGuideController::class, 'destroy'])->name('property.guide.destroy');


});



Route::post('logout', [LoginController::class, 'logout'])->name('logout');

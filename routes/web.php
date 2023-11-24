<?php
Auth::routes();
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyGuideController;
use App\Http\Controllers\FAQCategoryController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\LocalBusinessController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PropertyServiceController;

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

// If a user is not logged in, redirect to login page
Route::get('/', function () {
    // If the user is not logged in, redirect to login
    if (!auth()->check()) {
        return redirect('/login');
    }
    
    // If the user is logged in and has the role 'admin', redirect to admin dashboard
    if (auth()->user()->role === 'admin') {
        return redirect('/admin/dashboard');
    }
    
    // If the user is logged in and has the role 'owner', redirect to owner dashboard
    if (auth()->user()->role === 'owner') {
        return redirect('/owner/dashboard');
    }

    // If no conditions are met, redirect to login for now.
    // You can adjust this as needed.
    return redirect('/login');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::post('/admin/add-user', [AdminController::class, 'addUser'])->name('admin.addUser');

});

Route::middleware(['auth', 'role:owner'])->group(function () {
    // Owner's Routes
    Route::get('/owner/dashboard', [OwnerController::class, 'index'])->name('owner.dashboard');
    Route::get('/owner/{id}/edit', [OwnerController::class, 'edit'] )->name('owner.edit');
    Route::put('/owner/{id}', [OwnerController::class, 'update'])->name('owner.update');
    Route::post('/owner/renew-token', [OwnerController::class, 'renewToken'])->name('owner.renewToken');
 
    Route::get('/property/new', [PropertyController::class, 'index'])->name('property.index');
    Route::post('/property/store', [PropertyController::class, 'store'])->name('property.store');
    //Route::get('/property/{id}', [PropertyController::class, 'show'])->name('property.show');
    Route::get('/property/{id}/edit', [PropertyController::class, 'edit'])->name('property.edit');
    Route::get('/property/{id}/{tab?}', [PropertyController::class, 'show'])->name('property.show');


    Route::put('/property/{id}', [PropertyController::class, 'update'])->name('property.update');
    // Property's Guides Routes
    Route::get('property/{property}/guide/create', [PropertyGuideController::class, 'create'])->name('guide.create');
    Route::post('property/{property}/guide', [PropertyGuideController::class, 'store'])->name('guide.store');
    Route::get('property/{property}/guide/{guide}/edit', [PropertyGuideController::class, 'edit'])->name('guide.edit');
    Route::put('property/{property}/guide/{guide}', [PropertyGuideController::class, 'update'])->name('guide.update');
    Route::delete('property/{property}/guide/{guide}',  [PropertyGuideController::class, 'destroy'])->name('property.guide.destroy');
    // Property's FAQs Routes
    Route::post('/faq-category/store', [FAQCategoryController::class, 'store'])->name('faq_category.store');
    Route::post('/faq/store', [FAQController::class, 'store'])->name('faq.store');
    // Property's Local Busineses Routes
    Route::get('property/{property}/local-business/create', [LocalBusinessController::class, 'create'])->name('local-business.create');
    Route::post('property/{property}/local-business', [LocalBusinessController::class, 'store'])->name('local-business.store');
    Route::get('property/{property}/local-business/{localBusiness}/edit', [LocalBusinessController::class, 'edit'])->name('local-business.edit');
    Route::put('property/{property}/local-business/{localBusiness}', [LocalBusinessController::class, 'update'])->name('local-business.update');
    Route::delete('property/{property}/local-business/{localBusiness}', [LocalBusinessController::class, 'destroy'])->name('local-business.destroy');
    // Property's Services Routes
    Route::get('property/{property}/service/create', [PropertyServiceController::class, 'create'])->name('service.create');
    Route::post('property/{property}/service', [PropertyServiceController::class, 'store'])->name('service.store');
    Route::get('property/{property}/service/{service}/edit', [PropertyServiceController::class, 'edit'])->name('service.edit');
    Route::put('service/{service}', [PropertyServiceController::class, 'update'])->name('service.update');
    Route::delete('property/{property}/service/{service}', [PropertyServiceController::class, 'destroy'])->name('property.service.destroy');


    /*for testing*/
    Route::get('property/{property}/service/{service}', [PropertyServiceController::class, 'show'])->name('service.show');


});



Route::post('logout', [LoginController::class, 'logout'])->name('logout');

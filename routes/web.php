<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerRequestController;

/*
|--------------------------------------------------------------------------
| Root Redirect
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register.perform');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    | Dashboard
    */
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    /*
    | Cars (CRUD)
    */
    Route::resource('cars', CarController::class);

    /*
    | Seller: My Cars
    */
    Route::get('/my-cars', [CarController::class, 'myCars'])->name('cars.my');

    /*
    | User: Browse / Buy / Rent
    */
    Route::get('/browse-cars', [CarController::class, 'browse'])->name('cars.browse');
    Route::get('/buy-cars', [CarController::class, 'buyCars'])->name('cars.buy');
    Route::get('/rent-cars', [CarController::class, 'rentCars'])->name('cars.rent');

    /*
    | Requests
    */
    Route::post('/requests/send', [RequestController::class, 'store'])->name('requests.send');
    Route::get('/requests', [RequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/buy', [RequestController::class, 'buyRequests'])->name('requests.buy');
    Route::get('/requests/rent', [RequestController::class, 'rentRequests'])->name('requests.rent');
    Route::post('/requests/{id}/status', [RequestController::class, 'updateStatus'])->name('requests.status');
    Route::post('/requests/{id}/rent-available', [RequestController::class, 'makeAvailableAgain'])->name('requests.rent.available');

    /*
    | User: My Requested Cars
    */
    Route::get('/my-requests', [RequestController::class, 'userRequests'])->name('requests.user');

    /*
    | Seller: Manage Requests
    */
    Route::get('/seller/requests', [SellerRequestController::class, 'index'])->name('seller.requests');
    Route::get('/seller/requests/buy', [SellerRequestController::class, 'buyRequests'])->name('seller.requests.buy');
    Route::get('/seller/requests/rent', [SellerRequestController::class, 'rentRequests'])->name('seller.requests.rent');
    Route::post('/seller/requests/{request}/approve', [SellerRequestController::class, 'approve'])->name('seller.requests.approve');

    /*
    | Profile
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

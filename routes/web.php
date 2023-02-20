<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

## Listings Routes ##

// show all listings
Route::get('/', [ListingController::class, 'index'])
    ->name('listings.index');

// show manage listings
Route::get('/listings/manage', [ListingController::class, 'manage'])
->name('listings.manage')
->middleware('auth');

// show create form
Route::get('/listings/create', [ListingController::class, 'create'])
    ->name('listings.create')
    ->middleware('auth');

// store new listing
Route::post('/listings', [ListingController::class, 'store'])
    ->name('listings.store')
    ->middleware('auth');

// show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])
    ->name('listings.edit')
    ->middleware('auth');

// delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'delete'])
    ->name('listings.delete')
    ->middleware('auth');

// edit submit to update
Route::put('/listings/{listing}', [ListingController::class, 'update'])
    ->name('listings.update')
    ->middleware('auth');

// show single listing (needs to be at the bottom)
Route::get('/listings/{listing}', [ListingController::class, 'show'])
    ->name('listings.show');



## Users Routes ##

// show registration form
Route::get('/register', [UserController::class, 'create'])
    ->name('users.register')
    ->middleware('guest');
// store new user data
Route::post('/users', [UserController::class, 'store'])->name('users.store');
// logout user
Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');
// show login form
Route::get('/login', [UserController::class, 'login'])
    ->name('users.login')
    ->middleware('guest');
// login user
Route::post('/authenticate', [UserController::class, 'authenticate'])->name('users.authenticate');

<?php

use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\Route;

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

Route::group([], function () {
    Route::get('/', [FlightController::class, 'index']);

    Route::post('/get_token', [FlightController::class, 'get_token']);
    Route::match(['get', 'post'], '/search_flight', [FlightController::class, 'search_flight'])->name('flight.search');
    Route::match(['get', 'post'], '/search_city', [FlightController::class, 'search_city'])->name('search_city');
    Route::get('/search-airlines', [FlightController::class, 'search_airlines'])->name('search_airlines');

});

// Route::get('/', function () {
//     return view('index');
// });
// Route::get('/flights/token', [FlightController::class, 'getToken']);
// Route::get('/flight-offers', [FlightController::class, 'search'])->name('flight.offers');
// Route::post('/flight-pricing', [FlightController::class, 'getPricing']);
// Route::get('/flight-search', [FlightController::class, 'searchFlightOffers'])->name('flight.search');

Route::get('/flights/passengers', [FlightController::class, 'passengers'])->name('flights.payment');
Route::get('/flights/payment', [FlightController::class, 'payment'])->name('flights.payment');
Route::get('/flights/confirm', [FlightController::class, 'confirm'])->name('process.confirm');

// Route::post('/process-payment', [FlightController::class, 'processPayment'])->name('process.payment');

<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\TicketController;
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
    Route::get('/', [FlightController::class, 'index'])->name('index');

    Route::post('/get_token', [FlightController::class, 'get_token']);
    Route::match(['get', 'post'], '/search_flight', [FlightController::class, 'search_flight'])->name('flight.search');
    Route::post('/flight/select', [FlightController::class, 'selectFlight'])->name('flight.select');
    Route::get('/flight/passengers', [FlightController::class, 'passengers'])->name('flight.passengers');
    Route::post('/flight/store-passengers', [FlightController::class, 'storePassengers'])->name('flight.storePassengers');
    Route::get('/flight/payment', [FlightController::class, 'payment'])->name('flight.payment');
    Route::post('/flight/store-payment', [FlightController::class, 'storePayment'])->name('flight.storePayment');
    Route::get('/flight/confirm', [FlightController::class, 'confirm'])->name('flight.confirm');
    Route::match(['get', 'post'], '/explore_places', [FlightController::class, 'explorePlaces'])->name('explore_places');
    Route::match(['get', 'post'], '/terms&conditions', [FlightController::class, 'terms_conditions'])->name('terms_conditions');
    Route::match(['get', 'post'], '/privacy_policy', [FlightController::class, 'privacy_policy'])->name('privacy_policy');
    Route::match(['get', 'post'], '/important_guideline', [FlightController::class, 'important_guideline'])->name('important_guideline');
    Route::match(['get', 'post'], '/cancellation_policy', [FlightController::class, 'cancellation_policy'])->name('cancellation_policy');
    Route::match(['get', 'post'], '/about_us', [FlightController::class, 'aboutUs'])->name('about_us');
    Route::match(['get', 'post'], '/contact_us', [FlightController::class, 'contactUs'])->name('contact_us');
    // Route::match(['get', 'post'], '/search_flight', [FlightController::class, 'search_flight'])->name('flight.search');
    Route::match(['get', 'post'], '/search_city', [FlightController::class, 'search_city'])->name('search_city');
    Route::get('/search-airlines', [FlightController::class, 'search_airlines'])->name('search_airlines');

});

Route::get('tickets/download/{filename}', [TicketController::class, 'downloadPDF'])->name('tickets.download');

Route::post('/generate-pdf', [TicketController::class, 'generatePDF'])->name('generate.pdf');

Route::post('/subscribe', [FlightController::class, 'subscribe'])->name('subscription');
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

// Route::get('/indext', function () {
//     return view('indext');
// });

// Route::get('/flights/passengers', [FlightController::class, 'passengers'])->name('flights.passengers');
// Route::get('/flights/payment', [FlightController::class, 'payment'])->name('flights.payment');
// Route::get('/flights/confirm', [FlightController::class, 'confirm'])->name('process.confirm');

Route::get('/indexs', function () {
    return view('indexs');
});
Route::get('/terms&conditions', function () {
    return view('terms&conditions');
});
Route::get('/privacy_policy', function () {
    return view('privacy_policy');
});
// Route::get('/exploreplaces', function () {
//     return view('explore-places');
// });
// Route::get('/newflight', function () {
//     return view('flights.new-flight');
// });
// Route::get('/newpassenger', function () {
//     return view('flights.new-passengers');
// });
// Route::get('/newpayment', function () {
//     return view('flights.new-payment');
// });
// Route::get('/newconfirm', function () {
//     return view('emails.booking-confirmation');
// });

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
    Route::match(['get', 'post'], '/about_us', [FlightController::class, 'aboutUs'])->name('about_us');
    Route::match(['get', 'post'], '/contact_us', [FlightController::class, 'contactUs'])->name('contact_us');
    // Route::match(['get', 'post'], '/search_flight', [FlightController::class, 'search_flight'])->name('flight.search');
    Route::match(['get', 'post'], '/search_city', [FlightController::class, 'search_city'])->name('search_city');
    Route::get('/search-airlines', [FlightController::class, 'search_airlines'])->name('search_airlines');

});

// Route::get('/confirmation', [FlightController::class, 'confirmation'])->name('confirmation');

// Route::get('/', function () {
//     return view('index');
// });
// Route::get('/flights/token', [FlightController::class, 'getToken']);
// Route::get('/flight-offers', [FlightController::class, 'search'])->name('flight.offers');
// Route::post('/flight-pricing', [FlightController::class, 'getPricing']);
// Route::get('/flight-search', [FlightController::class, 'searchFlightOffers'])->name('flight.search');
Route::get('tickets/download/{filename}', [TicketController::class, 'downloadPDF'])->name('tickets.download');

Route::post('/generate-pdf', [TicketController::class, 'generatePDF'])->name('generate.pdf');

Route::get('/send-mail', [FlightController::class, 'sendMail']);

Route::post('/subscribe', [FlightController::class, 'subscribe'])->name('subscribe');

// Route::post('/process-payment', [FlightController::class, 'processPayment'])->name('process.payment');
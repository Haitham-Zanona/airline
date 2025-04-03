<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyTestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $selectedFlight;
    public $flightData;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        // If $data is already the selectedFlight (for backward compatibility)
        if (isset($data['itineraries']) || isset($data['passengers'])) {
            $this->selectedFlight = $data;
            $this->flightData     = session('flight_search', []);
        } else {
            // If $data is the structured array with both selectedFlight and flightData
            $this->selectedFlight = $data['selectedFlight'] ?? $data;
            $this->flightData     = $data['flightData'] ?? session('flight_search', []);
        }

    }

    public function build()
    {
        return $this->subject('Flight Booking Confirmation')
            ->view('emails.booking-confirmation');

    }

}

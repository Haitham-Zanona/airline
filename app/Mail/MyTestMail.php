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
    public $type;
    public $email;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        // Check if this is a subscription email
        if (isset($data['type']) && $data['type'] === 'subscription') {
            $this->type  = 'subscription';
            $this->email = $data['email'];
        } else {
            // Existing flight booking logic
            if (isset($data['itineraries']) || isset($data['passengers'])) {
                $this->selectedFlight = $data;
                $this->flightData     = session('flight_search', []);
            } else {
                $this->selectedFlight = $data['selectedFlight'] ?? $data;
                $this->flightData     = $data['flightData'] ?? session('flight_search', []);
            }
            $this->type = 'booking';
        }
    }

    public function build()
    {
        if ($this->type === 'subscription') {
            return $this->subject('Welcome to Our Newsletter!')
                ->view('emails.subscription');
        }

        return $this->subject('Flight Booking Confirmation')
            ->view('emails.booking-confirmation');
    }

}
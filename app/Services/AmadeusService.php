<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class AmadeusService
{
    private $clientId;
    private $clientSecret;
    private $tokenUrl;

    public function __construct()
    {
        $this->clientId     = env('AMADEUS_API_KEY');
        $this->clientSecret = env('AMADEUS_API_SECRET');
        $this->tokenUrl     = 'https://test.api.amadeus.com/v1/security/oauth2/token';
    }

    /**
     * 🔹 جلب Access Token من Amadeus API
     */
    public function getAccessToken()
    {

        $response = Http::asForm()->post($this->tokenUrl, [
            'grant_type'    => 'client_credentials',
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]);

        if ($response->failed()) {
            return null;
        }

        return $response->json()['access_token'] ?? null;
    }

}
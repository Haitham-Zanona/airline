<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class FlightOfferService
{
    // دالة لاسترجاع التوكن
    private function getAccessToken()
    {
        $clientId     = env('AMADEUS_CLIENT_ID');     // استرجاع الـ client_id من البيئة
        $clientSecret = env('AMADEUS_CLIENT_SECRET'); // استرجاع الـ client_secret من البيئة

        // بناء الـ URL للـ POST request لاسترجاع التوكن
        $url = 'https://test.api.amadeus.com/v1/security/oauth2/token';

        $response = Http::asForm()->post($url, [
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'grant_type'    => 'client_credentials',
        ]);

        if ($response->successful()) {
            return $response->json()['access_token']; // استرجاع الـ access_token
        } else {
            return null; // في حالة فشل الحصول على التوكن
        }
    }
    public function getFlightOffers($origin, $destination, $departureDate, $returnDate, $adults)
    {
        $accessToken = $this->getAccessToken();
        // هنا هنجيب التوكن من الخدمة السابقة

        // بناء الـ URL للـ GET request
        $url = 'https://test.api.amadeus.com/v2/shopping/flight-offers?' .
            "originLocationCode={$origin}" .
            "&destinationLocationCode={$destination}" .
            "&departureDate={$departureDate}" .
            "&returnDate={$returnDate}" .
            "&adults={$adults}&max=5";

        // إرسال الطلب باستخدام HTTP Client في Laravel
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type'  => 'application/json',
        ])->get($url);

        // التحقق من نجاح الطلب
        if ($response->successful()) {
            return $response->json(); // الرد بنوع JSON
        } else {
            return $response->body(); // لو في خطأ نرجع رسالة الخطأ
        }
    }

    public function getFlightPricing($flightOfferData)
    {
        // الحصول على التوكين
        $accessToken = $this->getAccessToken();

        // إعداد البيانات لطلب الـ POST
        $data = [
            'data' => [
                'type'         => 'flight-offers-pricing',
                'flightOffers' => [
                    $flightOfferData,
                ],
            ],
        ];

        // إرسال الطلب
        $response = Http::withHeaders([
            'Authorization'          => 'Bearer ' . $accessToken,
            'Content-Type'           => 'application/json',
            'X-HTTP-Method-Override' => 'GET', // لتجاوز الـ GET وتفعيله كـ POST
        ])->post('https://test.api.amadeus.com/v1/shopping/flight-offers/pricing', $data);

        return $response->json(); // إرجاع النتيجة
    }
}
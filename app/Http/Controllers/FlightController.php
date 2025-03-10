<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MyTestMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use Rinvex\Country\CountryLoader;

class FlightController extends Controller
{
    public function index()
    {

        return view('indext');
    }

    public $client_id     = 'pMnIJxm6ArkXSDvI4FhSs8NhBw660Qte';
    public $client_secret = 'SVDZHMGGHWvLcGuK';

    public function get_token()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://test.api.amadeus.com/v1/security/oauth2/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => 'client_id=' . $this->client_id . '&client_secret=' . $this->client_secret . '&grant_type=client_credentials',
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/x-www-form-urlencoded',
            ],
        ]);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($curl);
        if ($response === false) {
            dd(curl_error($curl));
        }
        curl_close($curl);

        return json_decode($response)->access_token;
    }

    public function search_flight(Request $request)
    {
        $departureDate = Carbon::parse($request->departureDate)->format('Y-m-d');
        $returnDate    = $request->has('returnDate') ? Carbon::parse($request->returnDate)->format('Y-m-d') : null;

        $token = $this->get_token();
        // dd($token);
        $travelers = "";
        for ($i = 1; $i <= request()->adults; $i++) {
            $travelers .= '
                {
                    "id": "' . $i . '",
                    "travelerType": "ADULT",
                    "fareOptions": [
                        "STANDARD"
                    ]
                }' . (($i != request()->adults) ? ',' : '') . '
            ';
        }

        $orign_location = '
            {
                "id": "1",
                "originLocationCode": "' . request()->origin_city . '",
                "destinationLocationCode": "' . request()->destination_city . '",
                "departureDateTimeRange": {
                    "date": "' . $departureDate . '",
                    "time": "10:00:00"
                }
            }
        ';

        if (isset($returnDate)) {
            $orign_location .= ',
                {
                    "id": "2",
                    "originLocationCode": "' . request()->destination_city . '",
                    "destinationLocationCode": "' . request()->origin_city . '",
                    "departureDateTimeRange": {
                        "date": "' . $returnDate . '",
                        "time": "10:00:00"
                    }
                }
            ';
        }

        $cabinClass = strtoupper($request->input('cabin', 'ECONOMY'));

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://test.api.amadeus.com/v2/shopping/flight-offers',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => '{
                "currencyCode": "USD",
                "originDestinations": [
                    ' . $orign_location . '
                ],
                "travelers": [
                    ' . $travelers . '
                ],
                "sources": [
                    "GDS"
                ],
                "searchCriteria": {
                    "flightFilters": {
                        "cabinRestrictions": [
                            {
                                "cabin": "' . $cabinClass . '",
                                "coverage": "MOST_SEGMENTS",
                                "originDestinationIds": ["1", "2"]
                            }
                        ]
                    }
                }
            }',
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'X-HTTP-Method-Override: GET',
                'Authorization: Bearer ' . $token . '',
            ],
        ]);

        // ,
        // "searchCriteria": {
        //     "maxFlightOffers": 2,
        //     "flightFilters": {
        //         "cabinRestrictions": [
        //             {
        //                 "cabin": "BUSINESS",
        //                 "coverage": "MOST_SEGMENTS",
        //                 "originDestinationIds": [
        //                     "1"
        //                 ]
        //             }
        //         ],
        //         "carrierRestrictions": {
        //             "excludedCarrierCodes": [
        //                 "AA",
        //                 "TP",
        //                 "AZ"
        //             ]
        //         }
        //     }
        // }

        //لازم نشيل هدول السطرين
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($curl);

        curl_close($curl);

        // $flightOffers = json_decode($response)->data;
        // return view('flights.flight-results', compact('flightOffers'));

        if (! $response) {
            dd("خطأ: لم يتم استلام أي استجابة من API");
        }

        $responseData = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            dd("خطأ في تحويل JSON: " . json_last_error_msg());
        }

        if (! isset($responseData['data'])) {
            dd("خطأ: لم يتم العثور على data", $responseData);
        }
        // dd($request->all());
        $flightsArray = json_decode($response, true)['data'] ?? [];
        // dd($flightsArray);
        $flightData = [
            'originCityName'      => $request->input('origin_city'),
            'originCity'          => $request->input('origin_city_name'),
            'destinationCityName' => $request->input('destination_city'),
            'destinationCity'     => $request->input('destination_city_name'),
            'departureDate'       => $departureDate,
            'returnDate'          => $returnDate,
            'adults'              => $request->input('adults'),
            'cabin'               => $cabinClass,
        ];

// تحويل المصفوفة إلى Collection
        $flightsCollection = collect($flightsArray);

        $flightsCollection = $flightsCollection->map(function ($flightOffer) {
            // رحلة الذهاب
            $outboundStops                      = count($flightOffer['itineraries'][0]['segments']) - 1;
            $flightOffer['outbound_stops_text'] = $outboundStops == 0 ? "0" : "$outboundStops";

            // رحلة العودة (إن وجدت)
            $inboundText = "";
            if (isset($flightOffer['itineraries'][1])) {
                $inboundStops                      = count($flightOffer['itineraries'][1]['segments']) - 1;
                $flightOffer['inbound_stops_text'] = $inboundStops == 0 ? "0" : "$inboundStops";
            }

            // dd($flightOffer['itineraries'][1]);

            return $flightOffer;
        });
        // dd($flightData);

                           // إعداد الترقيم اليدوي
        $perPage     = 20; // عدد الرحلات لكل صفحة
        $currentPage = request()->get('page', 1);
        $pagedData   = $flightsCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $flightOffers = new LengthAwarePaginator(
            $pagedData,                  // البيانات المصفاة
            $flightsCollection->count(), // إجمالي عدد الرحلات
            $perPage,                    // عدد الرحلات لكل صفحة
            $currentPage,                // الصفحة الحالية
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('flights.flight-results', compact('flightOffers', 'flightData'));

    }

    public function search_city()
    {
        $token = $this->get_token();
        $curl  = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://test.api.amadeus.com/v1/reference-data/locations?subType=AIRPORT&keyword=' . request()->q,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                'Authorization: Bearer ' . $token . '',
            ],
        ]);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($curl);
        if ($response === false) {
            dd(curl_error($curl));
        }
        curl_close($curl);

        $airports = json_decode($response);
        return $airports;
    }

    public function search_airlines()
    {
        $token = $this->get_token();

        // استقبال الأكواد من الطلب كمصفوفة
        $airlineCodes = explode(',', request()->query('airlineCodes'));

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://test.api.amadeus.com/v1/reference-data/airlines?airlineCodes=' . implode(',', $airlineCodes),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                'Authorization: Bearer ' . $token,
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $airlines = json_decode($response, true);

        // تحويل البيانات إلى مصفوفة `كود الشركة => اسمها`
        $airlineNames = [];
        if (! empty($airlines['data'])) {
            foreach ($airlines['data'] as $airline) {
                $airlineNames[$airline['iataCode']] = $airline['businessName'] ?? $airline['commonName'] ?? 'غير معروف';
            }
        }

        return response()->json($airlineNames);
    }

    public function getCountries()
    {
        // جلب قائمة الدول
        $countries = CountryLoader::countries();

        // استخراج أسماء الدول فقط
        return collect($countries)->map(function ($country) {
            return $country['name'] ?? 'Unknown';
        })->values()->toArray();
    }

    public function passengers()
    {
        return view('flights.passengers');
    }
    public function payment()
    {
        $countries = $this->getCountries();

        return view('flights.payment', compact('countries'));
    }
    public function confirm()
    {
        return view('flights.confirm');
    }

    public function sendMail()
    {
        $details = [
            'name'    => 'أحمد',
            'message' => 'هذا هو محتوى البريد التجريبي من Laravel.',
        ];

        Mail::to('recipient@example.com')->send(new MyTestMail($details));

        return "The email sent successfuly!";
    }

}

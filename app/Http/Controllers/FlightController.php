<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MyTestMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Monarobase\CountryList\CountryList;
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

    // يمكن إضافة هذه الدالة في Controller مناسب أو كـ Command

    public function importAirports()
    {
        // قائمة الأحرف للبحث المتسلسل عن المطارات
        $searchQueries = [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
        ];

        $totalImported = 0;

        foreach ($searchQueries as $query) {
            // استدعاء API للحصول على المطارات التي تبدأ بالحرف الحالي
            $token = $this->get_token();
            $curl  = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL            => 'https://test.api.amadeus.com/v1/reference-data/locations?subType=AIRPORT&keyword=' . $query,
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
            curl_close($curl);

            $result = json_decode($response, true);

            if (isset($result['data']) && ! empty($result['data'])) {
                foreach ($result['data'] as $airport) {
                    // تحقق مما إذا كان المطار موجودًا بالفعل
                    $exists = \App\Models\Airport::where('iata_code', $airport['iataCode'])->exists();

                    if (! $exists) {
                        // إضافة مطار جديد
                        \App\Models\Airport::create([
                            'iata_code'    => $airport['iataCode'],
                            'name'         => $airport['name'],
                            'city'         => $airport['address']['cityName'] ?? null,
                            'country'      => $airport['address']['countryName'] ?? null,
                            'country_code' => $airport['address']['countryCode'] ?? null,
                            'latitude'     => $airport['geoCode']['latitude'] ?? null,
                            'longitude'    => $airport['geoCode']['longitude'] ?? null,
                        ]);

                        $totalImported++;
                    }
                }
            }

            // انتظار قليلاً لتجنب تجاوز حدود API
            sleep(1);
        }

        return "The Airport $totalImported is imported successfully!";
    }

    public function get_airport_info($iataCode)
    {
        // محاولة استرجاع البيانات من التخزين المؤقت
        return Cache::remember('airport_' . $iataCode, 86400, function () use ($iataCode) {
            $token = $this->get_token();

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL            => 'https://test.api.amadeus.com/v1/reference-data/locations?subType=AIRPORT&locationId=' . $iataCode,
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

            $airports = json_decode($response, true);

            if (! empty($airports['data'][0])) {
                return [
                    'name'    => $airports['data'][0]['name'] ?? 'غير معروف',
                    'city'    => $airports['data'][0]['address']['cityName'] ?? 'غير معروف',
                    'country' => $airports['data'][0]['address']['countryName'] ?? 'غير معروف',
                ];
            }

            return ['name' => 'غير معروف', 'city' => 'غير معروف', 'country' => 'غير معروف'];
        });
    }

    public function get_airline_info($carrierCode)
    {
        // Cache airline data for 24 hours (86400 seconds)
        return Cache::remember('airline_' . $carrierCode, 86400, function () use ($carrierCode) {
            $token = $this->get_token();

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL            => 'https://test.api.amadeus.com/v1/reference-data/airlines?airlineCodes=' . $carrierCode,
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

            if (! empty($airlines['data'][0])) {
                return [
                    'name' => $airlines['data'][0]['businessName'] ?? $airlines['data'][0]['commonName'] ?? 'غير معروف',
                    'code' => $carrierCode,
                ];
            }

            return ['name' => 'غير معروف', 'code' => $carrierCode];
        });
    }

    public function search_flight(Request $request)
    {
        // $departureDate = Carbon::parse($request->departureDate)->format('Y-m-d');
        // $returnDate    = null;

        // if ($request->input('tripType') === 'roundTrip' && $request->has('returnDate')) {
        //     $returnDate = Carbon::parse($request->returnDate)->format('Y-m-d');
        // }
        // // dd($returnDate);
        // // $returnDate    = $request->has('returnDate') ? Carbon::parse($request->returnDate)->format('Y-m-d') : null;

        if ($request->has('origin_city') && $request->has('destination_city')) {
            session([
                'flight_search' => [
                    'origin_city'           => $request->origin_city,
                    'destination_city'      => $request->destination_city,
                    'origin_city_name'      => $request->origin_city_name,
                    'destination_city_name' => $request->destination_city_name,
                    'departureDate'         => $request->departureDate,
                    'returnDate'            => $request->returnDate,
                    'adults'                => $request->adults,
                    'cabin'                 => $request->input('cabin', 'ECONOMY'),
                    'tripType'              => $request->input('tripType', 'oneWay'),
                ],
            ]);
        }

        $searchData = session('flight_search', []);

        $origin_city      = $request->origin_city ?? $searchData['origin_city'] ?? null;
        $destination_city = $request->destination_city ?? $searchData['destination_city'] ?? null;
        $adults           = $request->adults ?? $searchData['adults'] ?? 1;

        if (empty($origin_city) || empty($destination_city)) {
            return redirect()->back()->with('error', 'Please select origin and destination city');
            // return redirect()->route('')->with('error', 'بيانات المدن غير متوفرة، يرجى إعادة البحث');
        }

        $departureDate = Carbon::parse($request->departureDate ?? $searchData['departureDate'])->format('Y-m-d');
        $returnDate    = null;

        if (($request->input('tripType') ?? $searchData['tripType']) === 'roundTrip') {
            if ($request->has('returnDate') || isset($searchData['returnDate'])) {
                $returnDate = Carbon::parse($request->returnDate ?? $searchData['returnDate'])->format('Y-m-d');
            }
        }

        $token = $this->get_token();
        // dd($token);
        $travelers = "";
        for ($i = 1; $i <= $adults; $i++) {
            $travelers .= '
                {
                    "id": "' . $i . '",
                    "travelerType": "ADULT",
                    "fareOptions": [
                        "STANDARD"
                    ]
                }' . (($i != $adults) ? ',' : '') . '
            ';
        }

        $orign_location = '
            {
                "id": "1",
                "originLocationCode": "' . $origin_city . '",
                "destinationLocationCode": "' . $destination_city . '",
                "departureDateTimeRange": {
                    "date": "' . $departureDate . '",
                    "time": "10:00:00"
                }
            }
        ';

        if ($request->input('tripType') === 'roundTrip' && isset($returnDate)) {
            $orign_location .= ',
                {
                    "id": "2",
                    "originLocationCode": "' . $destination_city . '",
                    "destinationLocationCode": "' . $origin_city . '",
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
                                "originDestinationIds": ' . (isset($returnDate) ? '["1", "2"]' : '["1"]') . '
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
            return redirect()->back()->with('error', 'Error: No response received from API');

        }

        $responseData = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return redirect()->back()->with('error', 'JSON parsing error: ' . json_last_error_msg());

        }

        if (! isset($responseData['data'])) {
            return redirect()->back()->with('error', 'Error: Data field not found in response');

        }
        // dd($request->all());
        $flightsArray = json_decode($response, true)['data'] ?? [];

        // جمع كل رموز المطارات الفريدة من النتائج
        $allAirportCodes = [];
        foreach ($flightsArray as $flight) {
            // جمع رموز المطارات من رحلة الذهاب
            foreach ($flight['itineraries'][0]['segments'] as $segment) {
                $allAirportCodes[] = $segment['departure']['iataCode'];
                $allAirportCodes[] = $segment['arrival']['iataCode'];
            }

            // جمع رموز المطارات من رحلة العودة (إذا وجدت)
            if (isset($flight['itineraries'][1])) {
                foreach ($flight['itineraries'][1]['segments'] as $segment) {
                    $allAirportCodes[] = $segment['departure']['iataCode'];
                    $allAirportCodes[] = $segment['arrival']['iataCode'];
                }
            }
        }

// إزالة الرموز المكررة
//         $allAirportCodes = array_unique($allAirportCodes);

// // الحصول على معلومات المطارات من قاعدة البيانات
//         $airports = \App\Models\Airport::whereIn('iata_code', $allAirportCodes)
//             ->get(['iata_code', 'city'])
//             ->keyBy('iata_code')
//             ->toArray();

// // تحويل البيانات للنموذج المطلوب
//         $airportToCity = [];
//         foreach ($allAirportCodes as $code) {
//             $airportToCity[$code] = $airports[$code]['city'] ?? 'Unknown';
//         }

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

// Convert array to collection

        $flightsCollection = collect($flightsArray);

        $flightsCollection = $flightsCollection->map(function ($flightOffer) {
            // Outbound flight

            $outboundStops = isset($flightOffer['itineraries'][0]['segments'])
            ? count($flightOffer['itineraries'][0]['segments']) - 1
            : 0;
            $flightOffer['outbound_stops_text'] = $outboundStops == 0 ? "0" : "$outboundStops";

            // إضافة معلومات الخطوط الجوية لكل جزء من الرحلة
            $flightOffer['segments_info'] = [];
            foreach ($flightOffer['itineraries'][0]['segments'] as $segment) {
                $carrierCode = $segment['carrierCode'];
                $airlineInfo = $this->get_airline_info($carrierCode);

                $flightOffer['segments_info'][] = [
                    'carrierCode'  => $carrierCode,
                    'airline_info' => $airlineInfo,
                    'departure'    => [
                        'iataCode' => $segment['departure']['iataCode'],
                        'at'       => $segment['departure']['at'],
                    ],
                    'arrival'      => [
                        'iataCode' => $segment['arrival']['iataCode'],
                        'at'       => $segment['arrival']['at'],
                    ],
                    'flightNumber' => $segment['number'],
                    'duration'     => $segment['duration'] ?? null,
                ];
            }

            // رحلة العودة (إذا كانت موجودة)
            if (isset($flightOffer['itineraries'][1]) && isset($flightOffer['itineraries'][1]['segments'])) {
                $inboundStops                      = count($flightOffer['itineraries'][1]['segments']) - 1;
                $flightOffer['inbound_stops_text'] = $inboundStops == 0 ? "0" : "$inboundStops";

                // إضافة معلومات الخطوط الجوية لرحلة العودة
                $flightOffer['return_segments_info'] = [];
                foreach ($flightOffer['itineraries'][1]['segments'] as $segment) {
                    $carrierCode = $segment['carrierCode'];
                    $airlineInfo = $this->get_airline_info($carrierCode);

                    $flightOffer['return_segments_info'][] = [
                        'carrierCode'  => $carrierCode,
                        'airline_info' => $airlineInfo,
                        'departure'    => [
                            'iataCode' => $segment['departure']['iataCode'],
                            'at'       => $segment['departure']['at'],
                        ],
                        'arrival'      => [
                            'iataCode' => $segment['arrival']['iataCode'],
                            'at'       => $segment['arrival']['at'],
                        ],
                        'flightNumber' => $segment['number'],
                        'duration'     => $segment['duration'] ?? null,
                    ];
                }
            }

            return $flightOffer;
        });

        // dd($flightData);

        // تطبيق الفلاتر
        if ($request->has('stops')) {
            $stops             = array_map('intval', $request->stops);
            $flightsCollection = $flightsCollection->filter(function ($flight) use ($stops) {
                $maxStops = max($flight['outbound_stops'], $flight['inbound_stops'] ?? 0);
                return in_array($maxStops, $stops);
            });
        }

        if ($request->has('departureTime')) {
            $departureRange    = $request->departureTime;
            $flightsCollection = $flightsCollection->filter(function ($flight) use ($departureRange) {
                $departureTime = (int) Carbon::parse($flight['itineraries'][0]['segments'][0]['departure']['at'])->format('Hi');
                return $departureTime >= $departureRange[0] && $departureTime <= $departureRange[1];
            });
        }

        if ($request->has('arrivalTime')) {
            $arrivalRange      = $request->arrivalTime;
            $flightsCollection = $flightsCollection->filter(function ($flight) use ($arrivalRange) {
                $arrivalTime = (int) Carbon::parse(end($flight['itineraries'][0]['segments'])['arrival']['at'])->format('Hi');
                return $arrivalTime >= $arrivalRange[0] && $arrivalTime <= $arrivalRange[1];
            });
        }

        // إعداد الترقيم اليدوي
        // Pagination مع الحفاظ على معلمات الفلتر
        $perPage     = 20;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $pagedData   = $flightsCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $flightOffers = new LengthAwarePaginator(
            $pagedData,
            $flightsCollection->count(),
            $perPage,
            $currentPage,
            [
                'path'  => LengthAwarePaginator::resolveCurrentPath(),
                'query' => $request->query(),
            ]
        );

        return view('flights.new-flight', compact('flightOffers', 'flightData'));

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

    // public function search_airlines()
    // {
    //     $token = $this->get_token();

    //     // استقبال الأكواد من الطلب كمصفوفة
    //     $airlineCodes = explode(',', request()->query('airlineCodes'));

    //     $curl = curl_init();

    //     curl_setopt_array($curl, [
    //         CURLOPT_URL            => 'https://test.api.amadeus.com/v1/reference-data/airlines?airlineCodes=' . implode(',', $airlineCodes),
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING       => '',
    //         CURLOPT_MAXREDIRS      => 10,
    //         CURLOPT_TIMEOUT        => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST  => 'GET',
    //         CURLOPT_HTTPHEADER     => [
    //             'Authorization: Bearer ' . $token,
    //         ],
    //     ]);

    //     $response = curl_exec($curl);
    //     curl_close($curl);

    //     $airlines = json_decode($response, true);

    //     // تحويل البيانات إلى مصفوفة `كود الشركة => اسمها`
    //     $airlineNames = [];
    //     if (! empty($airlines['data'])) {
    //         foreach ($airlines['data'] as $airline) {
    //             $airlineNames[$airline['iataCode']] = $airline['businessName'] ?? $airline['commonName'] ?? 'غير معروف';
    //         }
    //     }

    //     return response()->json($airlineNames);
    // }

    public function getCountries()
    {
        // جلب قائمة الدول
        $countries = CountryLoader::countries();

        // استخراج أسماء الدول فقط
        return collect($countries)->map(function ($country) {
            return $country['name'] ?? 'Unknown';
        })->values()->toArray();
    }

    public function passengers(Request $request)
    {

        $countries = (new CountryList())->getList('en');
        // dd($countries);
        // $countries = CountryList::getList('en');
        // $request->validate([
        //     'phone' => ['required', 'phone:AUTO,SA,EG,US,AE'],
        // ]);

        return view('flights.new-passengers', compact('countries'));

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
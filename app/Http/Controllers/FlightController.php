<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MyTestMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
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
                    'name'    => $airports['data'][0]['name'] ?? 'Unknown',
                    'city'    => $airports['data'][0]['address']['cityName'] ?? 'Unknown',
                    'country' => $airports['data'][0]['address']['countryName'] ?? 'Unknown',
                ];
            }

            return ['name' => 'Unknown', 'city' => 'Unknown', 'country' => 'Unknown'];
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
                    'name' => $airlines['data'][0]['businessName'] ?? $airlines['data'][0]['commonName'] ?? 'Unknown',
                    'code' => $carrierCode,
                ];
            }

            return ['name' => 'Unknown', 'code' => $carrierCode];
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

        $validatedData = $request->validate([
            'origin_city'      => 'required',
            'destination_city' => 'required',
            'departureDate'    => 'required|date',
            'returnDate'       => 'nullable|date',
            'adults'           => 'required|integer|min:1',
            'children'         => 'nullable|integer',
            'held_infants'     => 'nullable|integer',
            'infants'          => 'nullable|integer',
            'tripType'         => 'required|in:oneWay,roundTrip',

        ]);

        // إضافة تخزين مؤقت للنتائج - بداية التعديل
        $cacheKey = 'flight_search_' . md5(json_encode([
            'origin_city'      => $request->input('origin_city'),
            'destination_city' => $request->input('destination_city'),
            'departureDate'    => $request->input('departureDate'),
            'returnDate'       => $request->input('returnDate'),
            'adults'           => $request->input('adults', 1),
            'cabin'            => $request->input('cabin', 'ECONOMY'),
            'tripType'         => $request->input('tripType', 'oneWay'),
            'airlines'         => $request->input('airlines', []),
            'stops'            => $request->input('stops', []),
            'departureTime'    => $request->input('departureTime', []),
            'arrivalTime'      => $request->input('arrivalTime', [])
        ]));

        $cacheDuration = 30; // مدة التخزين المؤقت بالدقائق

        // إذا كان طلب AJAX وكان هناك بيانات مخزنة
        if (Cache::has($cacheKey) && ! $request->has('refresh_cache')) {
            $cachedData = Cache::get($cacheKey);

            if ($request->ajax()) {
                $offset = (int) $request->input('offset', 0);
                $limit  = (int) $request->input('limit', 10);

                $paginatedFlights = collect($cachedData['flightsCollection'])->slice($offset, $limit);
                $hasMore          = collect($cachedData['flightsCollection'])->count() > ($offset + $limit);

                return response()->json([
                    'html'    => view('flights.partials.flight_results', [
                        'flightOffers' => $paginatedFlights,
                        'flightData'   => $cachedData['flightData'],
                    ])->render(),
                    'hasMore' => $hasMore,
                    'cached'  => true,
                ]);
            }

            return view('flights.new-flight', [
                'flightsArraySubset' => collect($cachedData['flightsCollection'])->slice(0, 10),
                'flightData'         => $cachedData['flightData'],
                'totalResults'       => collect($cachedData['flightsCollection'])->count(),
                'cached'             => true,
            ]);
        }

        if ($request->has('origin_city') && $request->has('destination_city')) {
            $totalChildren    = $request->input('children', 0);
            $totalHeldInfants = $request->input('held_infants', 0);
            $totalTravelers   = $request->adults + $totalChildren + $totalHeldInfants;

            session([
                'flight_search' => [
                    'origin_city'           => $request->origin_city,
                    'destination_city'      => $request->destination_city,
                    'origin_city_name'      => $request->origin_city_name,
                    'destination_city_name' => $request->destination_city_name,
                    'departureDate'         => $request->departureDate,
                    'returnDate'            => $request->returnDate,
                    'adults'                => $request->adults,
                    'children'              => $totalChildren,
                    'held_infants'          => $totalHeldInfants,
                    'total_travelers'       => $totalTravelers,
                    'cabin'                 => $request->input('cabin', 'ECONOMY'),
                    'tripType'              => $request->input('tripType', 'oneWay'),
                ],
            ]);
        }
        //  dd(session('flight_search'));

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
        // حساب إجمالي المسافرين
        // إضافة متغيرات للتحقق من عدد المسافرين
//         $totalAdults        = $request->input('adults', 1);
//         $totalChildren      = $request->input('children', 0);
//         $totalHeldInfants   = $request->input('held_infants', 0);
//         $totalInfants = $request->input('infants', 0);

//         $totalTravelers = $totalAdults + $totalChildren + $totalHeldInfants + $totalInfants;

//         $travelers     = [];
//         $travelerCount = 0;

// // المسافرون البالغون
//         for ($i = 1; $i <= $totalAdults; $i++) {
//             $travelers[] = [
//                 "id"           => (string) $i,
//                 "travelerType" => "ADULT",
//                 "fareOptions"  => ["STANDARD"],
//             ];
//             $travelerCount++;
//         }

// // الأطفال
//         for ($i = 1; $i <= $totalChildren; $i++) {
//             $travelers[] = [
//                 "id"           => (string) ($travelerCount + $i),
//                 "travelerType" => "CHILD",
//                 "fareOptions"  => ["STANDARD"],
//             ];
//             $travelerCount++;
//         }

// // الرضع المحمولين
//         for ($i = 1; $i <= $totalHeldInfants; $i++) {
//             $travelers[] = [
//                 "id"                => (string) ($travelerCount + $i),
//                 "travelerType"      => "HELD_INFANT",
//                 "associatedAdultId" => "1",
//                 "fareOptions"       => ["STANDARD"],
//             ];
//         }

// // الرضع الجالسين
//         for ($i = 1; $i <= $totalInfants; $i++) {
//             $travelers[] = [
//                 "id"                => (string) ($travelerCount + $totalHeldInfants + $i),
//                 "travelerType"      => "SEATED_INFANT",
//                 "associatedAdultId" => "1",
//                 "fareOptions"       => ["STANDARD"],
//             ];
//         }

// // تحويل المصفوفة إلى JSON
//         $travelers_json = json_encode($travelers);

//         $request->merge([
//             'travelers_json' => $travelers_json,
//         ]);

        // $travelers = "";
        // for ($i = 1; $i <= $adults; $i++) {
        //     $travelers .= '
        //         {
        //             "id": "' . $i . '",
        //             "travelerType": "ADULT",
        //             "fareOptions": [
        //                 "STANDARD"
        //             ]
        //         }' . (($i != $adults) ? ',' : '') . '
        //     ';
        // }

        // جمع بيانات المسافرين
        $totalAdults      = $request->input('adults', 1);
        $totalChildren    = $request->input('children', 0);
        $totalHeldInfants = $request->input('held_infants', 0);
        // $totalInfants = $request->input('infants', 0);

// إنشاء مصفوفة المسافرين
        $travelers     = [];
        $travelerCount = 0;

// المسافرون البالغون
        for ($i = 1; $i <= $totalAdults; $i++) {
            $travelers[] = [
                "id"           => (string) $i,
                "travelerType" => "ADULT",
                "fareOptions"  => ["STANDARD"],
            ];
            $travelerCount++;
        }

// الأطفال
        for ($i = 1; $i <= $totalChildren; $i++) {
            $travelers[] = [
                "id"           => (string) ($travelerCount + $i),
                "travelerType" => "CHILD",
                "fareOptions"  => ["STANDARD"],
            ];
            $travelerCount++;
        }

        $heldInfantsCount = min($totalHeldInfants, $totalAdults);

// الرضع المحمولين
        for ($i = 1; $i <= $heldInfantsCount; $i++) {
            $associatedAdultId = (string) (($i - 1) % $totalAdults + 1);

            $travelers[] = [
                "id"                => (string) ($travelerCount + $i),
                "travelerType"      => "HELD_INFANT",
                "associatedAdultId" => $associatedAdultId,
                "fareOptions"       => ["STANDARD"],
                "seatRequired"      => false,
            ];
            $travelerCount++;
        }

// الرضع الجالسين
        // for ($i = 1; $i <= $InfantsCount; $i++) {
        //     $associatedAdultId = (string) (($i - 1) % $totalAdults + 1);

        //     $travelers[] = [
        //         "id"                => (string) ($travelerCount + $i),
        //         "travelerType"      => "INFANT",
        //         "associatedAdultId" => $associatedAdultId,
        //         "fareOptions"       => ["STANDARD"],
        //         "seatRequired"      => true,
        //     ];
        //     $travelerCount++;

        // }

// تحويل إلى JSON بدون الأقواس الخارجية
        $travelers_json = json_encode($travelers);
        $travelers_json = substr($travelers_json, 1, -1);

// // جمع بيانات المسافرين
//         $totalAdults        = $request->input('adults', 1);
//         $totalChildren      = $request->input('children', 0);
//         $totalHeldInfants   = $request->input('held_infants', 0);
//         $totalInfants = $request->input('infants', 0);

// // إنشاء مصفوفة المسافرين
//         $travelers     = [];
//         $travelerCount = 0;

// // المسافرون البالغون
//         for ($i = 1; $i <= $totalAdults; $i++) {
//             $travelers[] = [
//                 "id"           => (string) $i,
//                 "travelerType" => "ADULT",
//                 "fareOptions"  => ["STANDARD"],
//             ];
//             $travelerCount++;
//         }

// // الأطفال
//         for ($i = 1; $i <= $totalChildren; $i++) {
//             $travelers[] = [
//                 "id"           => (string) ($travelerCount + $i),
//                 "travelerType" => "CHILD",
//                 "fareOptions"  => ["STANDARD"],
//             ];
//             $travelerCount++;
//         }

// // التأكد من أن عدد الرضع المحمولين لا يتجاوز عدد البالغين (قيود شركات الطيران)
//         $heldInfantsCount = min($totalHeldInfants, $totalAdults);

// // الرضع المحمولين - توزيعهم بالتساوي على البالغين
//         for ($i = 1; $i <= $heldInfantsCount; $i++) {
//             // التوزيع المتساوي - كل رضيع مرتبط ببالغ
//             $associatedAdultId = (string) (($i - 1) % $totalAdults + 1);

//             $travelers[] = [
//                 "id"                => (string) ($travelerCount + $i),
//                 "travelerType"      => "HELD_INFANT",
//                 "associatedAdultId" => $associatedAdultId, // ربط كل رضيع ببالغ محدد
//                 "fareOptions"       => ["STANDARD"],
//             ];
//             $travelerCount++;
//         }

// // الرضع الجالسين - يمكن توزيعهم بالتساوي أيضاً
//         for ($i = 1; $i <= $totalInfants; $i++) {
//             // التوزيع المتساوي - كل رضيع مرتبط ببالغ
//             $associatedAdultId = (string) (($i - 1) % $totalAdults + 1);

//             $travelers[] = [
//                 "id"                => (string) ($travelerCount + $i),
//                 "travelerType"      => "SEATED_INFANT",
//                 "associatedAdultId" => $associatedAdultId, // ربط كل رضيع ببالغ محدد
//                 "fareOptions"       => ["STANDARD"],
//             ];
//             $travelerCount++;
//         }

// // تحويل إلى JSON بدون الأقواس الخارجية
//         $travelers_json = json_encode($travelers);
//         $travelers_json = substr($travelers_json, 1, -1);

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
                    ' . $travelers_json . '
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

        // تقسيم معالجة البيانات - بداية التعديل
// تحويل المصفوفة إلى Collection وتقسيمها إلى دفعات صغيرة لتحسين الأداء
        $flightsCollection = collect();
        $chunkSize         = 50; // حجم الدفعة

// تقسيم البيانات إلى مجموعات للمعالجة
        foreach (collect($flightsArray)->chunk($chunkSize) as $index => $chunk) {
            // تسجيل الوقت للتشخيص
            $startTime = microtime(true);

            // معالجة كل دفعة من البيانات
            $processedChunk = $chunk->map(function ($flightOffer) {
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

            // إضافة النتائج المعالجة إلى المجموعة الرئيسية
            $flightsCollection = $flightsCollection->concat($processedChunk);

            // تسجيل وقت المعالجة للتشخيص
            $processingTime = microtime(true) - $startTime;
            Log::info("Processed chunk {$index} ({$chunk->count()} items) in {$processingTime} seconds");
        }

        // dd($flightData);
// Filter by airlines if specified
        if ($request->has('airlines') && is_array($request->airlines) && count($request->airlines) > 0) {
            $flightsCollection = $flightsCollection->filter(function ($flight) use ($request) {
                if (isset($flight['segments_info'][0]['airline_info']['name']) &&
                    $flight['segments_info'][0]['airline_info']['name'] !== 'UNKNOWN') {
                    return in_array($flight['segments_info'][0]['airline_info']['name'], $request->airlines);
                } else {
                    return in_array($flight['validatingAirlineCodes'][0] ?? 'Unknown Airline', $request->airlines);
                }
            });
        }

        // Filter by stops if specified
        if ($request->has('stops') && is_array($request->stops) && count($request->stops) > 0) {
            $flightsCollection = $flightsCollection->filter(function ($flight) use ($request) {
                $outboundStops = isset($flight['outbound_stops_text'])
                ? $flight['outbound_stops_text']
                : (isset($flight['itineraries'][0]['segments']) ? (count($flight['itineraries'][0]['segments']) - 1) : '0');

                // For inbound (return) flights if they exist
                $inboundStops = 0;
                if (isset($flight['itineraries'][1]) && isset($flight['itineraries'][1]['segments'])) {
                    $inboundStops = isset($flight['inbound_stops_text'])
                    ? $flight['inbound_stops_text']
                    : (count($flight['itineraries'][1]['segments']) - 1);
                }

                return in_array($outboundStops, $request->stops) || in_array($inboundStops, $request->stops);
            });
        }

        // Filter by departure time if specified
        if ($request->has('departureTime') && is_array($request->departureTime) && count($request->departureTime) == 2) {
            $departureRange    = $request->departureTime;
            $flightsCollection = $flightsCollection->filter(function ($flight) use ($departureRange) {
                $departureDateTime = Carbon::parse($flight['itineraries'][0]['segments'][0]['departure']['at']);
                $departureMinutes  = $departureDateTime->hour * 60 + $departureDateTime->minute;
                return $departureMinutes >= $departureRange[0] && $departureMinutes <= $departureRange[1];
            });
        }

        // Filter by arrival time if specified
        if ($request->has('arrivalTime') && is_array($request->arrivalTime) && count($request->arrivalTime) == 2) {
            $arrivalRange      = $request->arrivalTime;
            $flightsCollection = $flightsCollection->filter(function ($flight) use ($arrivalRange) {
                $lastSegmentIndex = count($flight['itineraries'][0]['segments']) - 1;
                $arrivalDateTime  = Carbon::parse($flight['itineraries'][0]['segments'][$lastSegmentIndex]['arrival']['at']);
                $arrivalMinutes   = $arrivalDateTime->hour * 60 + $arrivalDateTime->minute;
                return $arrivalMinutes >= $arrivalRange[0] && $arrivalMinutes <= $arrivalRange[1];
            });
        }
// تخزين النتائج في ذاكرة التخزين المؤقت - بداية التعديل
        $cacheData = [
            'flightsCollection' => $flightsCollection->toArray(),
            'flightData'        => $flightData,
        ];

        Cache::put($cacheKey, $cacheData, $cacheDuration * 60); // تخزين البيانات لمدة محددة بالثواني
                                                                // نهاية تعديل التخزين المؤقت

// للطلبات AJAX، قم بإرجاع عرض جزئي أو استجابة JSON
        if ($request->ajax()) {
            try {
                $offset = (int) $request->input('offset', 0);
                $limit  = (int) $request->input('limit', 10);

                // استخدام مجموعة البيانات التي تم تصفيتها
                $paginatedFlights = $flightsCollection->slice($offset, $limit);

                // التحقق مما إذا كان هناك المزيد من النتائج
                $hasMore = $flightsCollection->count() > ($offset + $limit);

                if ($paginatedFlights->isEmpty()) {
                    return response()->json([
                        'html'    => view('flights.partials.no_flights_found')->render(),
                        'hasMore' => false,
                    ]);
                }

                // إرجاع البيانات كاستجابة JSON
                return response()->json([
                    'html'    => view('flights.flight-results', [
                        'flightOffers' => $paginatedFlights,
                        'flightData'   => $flightData,
                    ])->render(),
                    'hasMore' => $hasMore,
                ]);
            } catch (\Exception $e) {
                // تسجيل الخطأ للتصحيح
                Log::error('Flight search error: ' . $e->getMessage());

                return response()->json(['error' => 'Internal Server Error: ' . $e->getMessage()], 500);
            }
        }

// للطلبات العادية، عرض الصفحة الكاملة
        return view('flights.new-flight', [
            'flightsArraySubset' => $flightsCollection->slice(0, 10),
            'flightData'         => $flightData,
            'totalResults'       => $flightsCollection->count(),
            'searchData'         => $searchData,

        ]);

        // // For AJAX requests, return partial view or JSON response
        // if ($request->ajax()) {
        //     $html = view('flights.partials.flight-results', compact('flightOffers', 'flightData'))->render();
        //     return response()->json(['html' => $html]);
        // }

        // return view('flights.new-flight', compact('flightsArraySubset', 'flightData'));

    }

    // public function search_flight(Request $request)
    // {
    //     $request->validate([
    //         'origin_city'      => 'required',
    //         'destination_city' => 'required',
    //         'departureDate'    => 'required|date',
    //         'adults'           => 'required|integer|min:1',
    //     ]);

    //     $departureDate = Carbon::parse($request->departureDate)->format('Y-m-d');
    //     $returnDate    = $request->returnDate ? Carbon::parse($request->returnDate)->format('Y-m-d') : null;

    //     $token = $this->get_token();

    //     $travelers = [];
    //     for ($i = 1; $i <= $request->adults; $i++) {
    //         $travelers[] = [
    //             "id"           => (string) $i,
    //             "travelerType" => "ADULT",
    //             "fareOptions"  => ["STANDARD"],
    //         ];
    //     }

    //     $originLocation = [
    //         [
    //             "id"                      => "1",
    //             "originLocationCode"      => $request->origin_city,
    //             "destinationLocationCode" => $request->destination_city,
    //             "departureDateTimeRange"  => ["date" => $departureDate, "time" => "10:00:00"],
    //         ],
    //     ];

    //     if ($request->tripType === 'roundTrip' && $returnDate) {
    //         $originLocation[] = [
    //             "id"                      => "2",
    //             "originLocationCode"      => $request->destination_city,
    //             "destinationLocationCode" => $request->origin_city,
    //             "departureDateTimeRange"  => ["date" => $returnDate, "time" => "10:00:00"],
    //         ];
    //     }

    //     $payload = [
    //         "currencyCode"       => "USD",
    //         "originDestinations" => $originLocation,
    //         "travelers"          => $travelers,
    //         "sources"            => ["GDS"],
    //         "searchCriteria"     => [
    //             "flightFilters" => [
    //                 "cabinRestrictions" => [
    //                     [
    //                         "cabin"                => strtoupper($request->cabin),
    //                         "coverage"             => "MOST_SEGMENTS",
    //                         "originDestinationIds" => isset($returnDate) ? ["1", "2"] : ["1"],
    //                     ],
    //                 ],
    //             ],
    //         ],
    //     ];

    //     $response     = Http::withToken($token)->post('https://test.api.amadeus.com/v2/shopping/flight-offers', $payload);
    //     $responseData = $response->json();

    //     if (! isset($responseData['data'])) {
    //         return response()->json(['error' => 'No flights found'], 404);
    //     }

    //     return response()->json($responseData['data']);
    // }

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
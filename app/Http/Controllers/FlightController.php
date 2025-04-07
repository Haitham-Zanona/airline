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
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
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

            // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

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

                // Get the airline name
                $airlineName = $airlines['data'][0]['businessName'] ?? $airlines['data'][0]['commonName'] ?? 'Unknown';

// Remove any travel class information (like "economy", "business", etc.)
                $airlineName = preg_replace('/(economy|business|first|premium)/i', '', $airlineName);
                $airlineName = trim($airlineName);

                return [
                    'name' => $airlineName,
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
        // dd(session('flight_search'));

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
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
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
// Fix the Filter Function: Ensure the filter function properly handles empty arrays

        try {
            // تحويل البيانات المستلمة إلى الصيغة المناسبة
            $filters = [
                'stops'         => is_array($request->stops) ? $request->stops : [],
                'airlines'      => is_array($request->airlines) ? $request->airlines : [],
                'departureTime' => $request->input('departureTime', [0, 1440]),
                'arrivalTime'   => $request->input('arrivalTime', [0, 1440]),
            ];

            Log::info('Applying filters:', $filters);

            // تطبيق الفلاتر على المجموعة
            $filteredFlights = $flightsCollection->filter(function ($flight) use ($filters) {
                return $this->matchesFilters($flight, $filters);
            });

            Log::info('Filtered results count:', ['count' => $filteredFlights->count()]);

            if ($request->ajax()) {
                $view = $filteredFlights->isEmpty()
                ? view('flights.partials.no_results')->render()
                : view('flights.partials.flight_results', [
                    'flightsArraySubset' => $filteredFlights,
                    'flightData'         => $flightData,
                ])->render();

                return response()->json([
                    'html'         => $view,
                    'hasMore'      => false,
                    'totalResults' => $filteredFlights->count(),
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Filter error:', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'error'   => 'Failed to apply filters',
                    'message' => $e->getMessage(),
                ], 500);
            }
        }

        // تأكد من أن كل رحلة تحتوي على معرّف فريد (أضف هذا الكود هنا)
        $flightsCollection = $flightsCollection->map(function ($flight, $index) {
            if (! isset($flight['id'])) {
                $flight['id'] = uniqid('flight_'); // إضافة معرّف فريد إذا لم يكن موجوداً
            }
            return $flight;
        });

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

                // تحضير البيانات المفلترة
                $paginatedFlights = $flightsCollection->slice($offset, $limit);
                $hasMore          = $flightsCollection->count() > ($offset + $limit);

                if ($paginatedFlights->isEmpty()) {
                    return response()->json([
                        'html'    => view('flights.partials.no_flights_found')->render(),
                        'hasMore' => false,
                    ]);
                }

                return response()->json([
                    'html'    => view('flights.partials.flight_results', [
                        'flightsArraySubset' => $paginatedFlights,
                        'flightData'         => $flightData,
                        'searchData'         => $searchData ?? [],
                    ])->render(),
                    'hasMore' => $hasMore
                ]);
            } catch (\Exception $e) {
                Log::error('Flight search error: ' . $e->getMessage());
                return response()->json([
                    'error' => 'Internal Server Error: ' . $e->getMessage(),
                ], 500);
            }
        }

        session(['flightsArraySubset' => $flightsCollection->toArray()]);

// للطلبات العادية، عرض الصفحة الكاملة
        return view('flights.new-flight', [
            'flightsArraySubset' => $flightsCollection,
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

    // Helper methods

    private function matchesFilters($flight, $filters)
    {
        // فلتر التوقفات
        if (! empty($filters['stops'])) {
            $outboundStops = $this->getStopsCount($flight, 'outbound');
            if (! in_array((string) $outboundStops, $filters['stops'])) {
                return false;
            }
        }

        // فلتر شركات الطيران
        if (! empty($filters['airlines'])) {
            $airlineName = $this->getAirlineName($flight);
            if (! in_array($airlineName, $filters['airlines'])) {
                return false;
            }
        }

        // فلتر وقت المغادرة
        if (! empty($filters['departureTime'])) {
            $departureTime = $this->getFlightTime($flight, 'departure');
            if (! $this->isTimeInRange($departureTime, $filters['departureTime'][0], $filters['departureTime'][1])) {
                return false;
            }
        }

        // فلتر وقت الوصول
        if (! empty($filters['arrivalTime'])) {
            $arrivalTime = $this->getFlightTime($flight, 'arrival');
            if (! $this->isTimeInRange($arrivalTime, $filters['arrivalTime'][0], $filters['arrivalTime'][1])) {
                return false;
            }
        }

        return true;
    }

    // في FlightController
    private function applyFilters($flightsCollection, $filters)
    {
        return $flightsCollection->filter(function ($flight) use ($filters) {
            $matchesAllFilters = true;

            // فلتر التوقفات
            if (! empty($filters['stops'])) {
                $outboundStops = $this->getStopsCount($flight, 'outbound');
                $matchesStops  = in_array((string) $outboundStops, $filters['stops']);
                $matchesAllFilters &= $matchesStops;

                // تسجيل للتحقق
                Log::info('Stops Filter', [
                    'flight_stops' => $outboundStops,
                    'filter_stops' => $filters['stops'],
                    'matches'      => $matchesStops,
                ]);
            }

            // فلتر شركات الطيران
            if (! empty($filters['airlines'])) {
                $airlineName    = $this->getAirlineName($flight);
                $matchesAirline = in_array($airlineName, $filters['airlines']);
                $matchesAllFilters &= $matchesAirline;

                // تسجيل للتحقق
                Log::info('Airline Filter', [
                    'flight_airline'  => $airlineName,
                    'filter_airlines' => $filters['airlines'],
                    'matches'         => $matchesAirline,
                ]);
            }

            return $matchesAllFilters;
        });
    }

    private function getStopsCount($flight, $direction = 'outbound')
    {
        $itineraryIndex = $direction === 'outbound' ? 0 : 1;
        if (isset($flight['itineraries'][$itineraryIndex]['segments'])) {
            return count($flight['itineraries'][$itineraryIndex]['segments']) - 1;
        }
        return 0;
    }

    private function getAirlineName($flight)
    {
        // تحسين استخراج اسم شركة الطيران
        if (isset($flight['segments_info'][0]['airline_info']['name'])) {
            $airlineName = $flight['segments_info'][0]['airline_info']['name'];
                                                                  // إزالة معلومات درجة الطيران
            Log::info('Airline Name Extracted: ' . $airlineName); // Add this line

            return preg_replace('/(economy|business|first|premium)/i', '', $airlineName);
        }
        $airlineName = $flight['validatingAirlineCodes'][0] ?? 'Unknown Airline';

        Log::info('Airline Name Extracted: ' . $airlineName); // Also log this case

        return $airlineName;
    }

    private function getFlightTime($flight, $type = 'departure')
    {
        $segment = $flight['itineraries'][0]['segments'][0];
        $time    = $type === 'departure' ? $segment['departure']['at'] : $segment['arrival']['at'];
        return \Carbon\Carbon::parse($time)->format('H:i');
    }

    private function isTimeInRange($time, $start, $end)
    {
        $flightTime = \Carbon\Carbon::parse($time);
        $flightDate = $flightTime->copy()->startOfDay(); // Get the date of the flight time
        $startTime  = $flightDate->copy()->addMinutes($start);
        $endTime    = $flightDate->copy()->addMinutes($end);

        // If the end time is before the start time, it means the range spans across midnight
        if ($end < $start) {
            // Adjust the end time to be on the next day
            $endTime->addDay();

            // Check if the flight time is within the range, considering the possibility of spanning midnight
            return $flightTime->gte($startTime) || $flightTime->lte($endTime);
        }

        return $flightTime->gte($startTime) && $flightTime->lte($endTime);
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
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
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

    /**
     * اختيار الرحلة المحددة وتخزينها في جلسة المستخدم
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function selectFlight(Request $request)
    {
        // الحصول على معرف الرحلة من النموذج
        $flightId = $request->input('flight_id');
        if (! $flightId) {
            // Log::error('Flight ID is missing in the request');
            return redirect()->route('index')->with('error', 'Flight ID is missing in the request');
        }

        // الحصول على بيانات الرحلات من الجلسة
        $flightOffers = session('flightsArraySubset', []);

        // تسجيل معلومات تشخيصية (مفيد لتتبع الأخطاء)
        // Log::info('Flight ID from request: ' . $flightId);
        // Log::info('Number of flights in session: ' . count($flightOffers));

        // البحث عن الرحلة المطلوبة
        $selectedFlight = null;
        foreach ($flightOffers as $flight) {
            if (isset($flight['id']) && $flight['id'] == $flightId) {
                $selectedFlight = $flight;
                Log::info('Found matching flight with ID: ' . $flightId);
                break;
            }
        }

        // إذا لم يتم العثور على الرحلة
        if (! $selectedFlight) {
            Log::error('Selected flight not found in session data');
            return redirect()->route('index')->with('error', 'Selected flight not found');
        }

        // تخزين الرحلة المختارة في الجلسة
        $this->storeSelectedFlightInSession($selectedFlight);
        // dd(session('flight_search'));

        // التوجيه إلى صفحة تفاصيل المسافرين
        return redirect()->route('flight.passengers');
    }

/**
 * تخزين بيانات الرحلة المحددة في جلسة المستخدم
 *
 * @param array $selectedFlight بيانات الرحلة المحددة
 * @return void
 */
    private function storeSelectedFlightInSession(array $selectedFlight)
    {
        $flightSearchData                    = session('flight_search', []);
        $flightSearchData['selected_flight'] = $selectedFlight;
        session(['flight_search' => $flightSearchData]);
    }

/**
 * إضافة بيانات إضافية إلى الرحلة المحددة في الجلسة
 *
 * @param array $additionalData البيانات الإضافية المراد إضافتها
 * @param bool $merge ما إذا كان سيتم دمج البيانات الجديدة مع القديمة (true) أو استبدالها (false)
 * @return void
 */
    public function addDataToSelectedFlight(array $additionalData, bool $merge = true)
    {
        $flightSearchData = session('flight_search', []);

        if (! isset($flightSearchData['selected_flight'])) {
            $flightSearchData['selected_flight'] = $additionalData;
        } else {
            if ($merge) {
                $flightSearchData['selected_flight'] = array_replace_recursive(
                    $flightSearchData['selected_flight'],
                    $additionalData
                );
            } else {
                foreach ($additionalData as $key => $value) {
                    $flightSearchData['selected_flight'][$key] = $value;
                }
            }
        }

        session(['flight_search' => $flightSearchData]);
    }

/**
 * الحصول على بيانات الرحلة المحددة من الجلسة
 *
 * @return array|null بيانات الرحلة المحددة أو null إذا لم تكن موجودة
 */
    public function getSelectedFlight()
    {
        return session('flight_search.selected_flight', null);
    }

    public function passengers(Request $request)
    {
        // الحصول على الرحلة المختارة من الجلسة
        $selectedFlight = $this->getSelectedFlight();

        // تسجيل معلومات تشخيصية (اختياري)
        Log::info('Retrieved selected flight for passengers page: ' . json_encode(['id' => $selectedFlight['id'] ?? 'not found']));

        // التحقق من وجود رحلة محددة
        if (! $selectedFlight) {
            return redirect()->route('index')->with('error', 'Please select a flight first');
        }

        // الحصول على قائمة البلدان للقائمة المنسدلة
        $countries = (new CountryList())->getList('en');

        // dd(session('flight_search'));

        // الحصول على عدد المسافرين من بيانات البحث
        $flightSearchData    = session('flight_search', []);
        $originCityName      = $flightSearchData['origin_city_name'] ?? 'Unknown Origin';
        $destinationCityName = $flightSearchData['destination_city_name'] ?? 'Unknown Destination';
        $adults              = $flightSearchData['adults'] ?? 1;
        $children            = $flightSearchData['children'] ?? 0;
        $infants             = $flightSearchData['held_infants'] ?? 0;

        // استرجاع بيانات المسافرين المخزنة مسبقاً (إن وجدت)
        $savedPassengers = $selectedFlight['passengers'] ?? [];
        $contactInfo     = $selectedFlight['contact'] ?? [];

        // dd(session('flight_search'));

        // تمرير البيانات للعرض
        return view('flights.new-passengers', compact(
            'selectedFlight',
            'countries',
            'adults',
            'children',
            'infants',
            'savedPassengers',
            'contactInfo',
            'originCityName',
            'destinationCityName'
        ));
    }

    /**
     * معالجة بيانات المسافرين وتخزينها في الجلسة
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePassengers(Request $request)
    {
        try {
            // Log the incoming request data
            Log::info('Passenger form submission:', $request->all());

            $flightSearchData        = session('flight_search', []);
            $expectedAdults          = $flightSearchData['adults'] ?? 1;
            $expectedChildren        = $flightSearchData['children'] ?? 0;
            $expectedInfants         = $flightSearchData['held_infants'] ?? 0;
            $totalExpectedPassengers = $expectedAdults + $expectedChildren + $expectedInfants;

            // Validate the request data
            $validated = $request->validate([
                'passengers'                   => 'required|array',
                'passengers.*.type'            => 'required|string|in:ADULT,CHILD,HELD_INFANT',
                'passengers.*.title'           => 'required|string',
                'passengers.*.firstName'       => 'required|string',
                'passengers.*.middleName'      => 'required|string',
                'passengers.*.lastName'        => 'required|string',
                'passengers.*.birthDate'       => 'required|date',
                'passengers.*.gender'          => 'required|string|in:M,F',
                'passengers.*.nationality'     => 'required|string',
                'passengers.*.associatedAdult' => 'required_if:passengers.*.type,HELD_INFANT',
                'contact.email'                => 'required|email',
                'contact.phone'                => 'required|string',
            ]);

            // Verify passenger count
            if (count($validated['passengers']) !== $totalExpectedPassengers) {
                Log::warning('Passenger count mismatch', [
                    'expected' => $totalExpectedPassengers,
                    'received' => count($validated['passengers']),
                ]);
                return redirect()->back()
                    ->withErrors(['error' => 'The number of passengers does not match the booking requirements.'])
                    ->withInput();
            }

            // Store data in session
            $this->addDataToSelectedFlight([
                'passengers' => $validated['passengers'],
                'contact'    => $validated['contact'],
            ]);

            Log::info('Passengers data stored successfully');
            return redirect()->route('flight.payment');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', ['errors' => $e->errors()]);
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Error storing passengers:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while processing your request. Please try again.'])
                ->withInput();
        }
    }

    public function payment()
    {
        // الحصول على الرحلة المختارة من الجلسة
        $selectedFlight = $this->getSelectedFlight();

// التحقق من اختيار رحلة وإدخال بيانات المسافرين
        if (! $selectedFlight) {
            return redirect()->route('index')->with('error', 'الرجاء اختيار رحلة أولاً');
        }

        if (! isset($selectedFlight['passengers'])) {
            return redirect()->route('flight.passengers')->with('error', 'الرجاء إدخال بيانات المسافرين أولاً');
        }

        $countries = $this->getCountries();

// استرجاع بيانات الدفع المخزنة مسبقاً (إن وجدت)
        $paymentInfo = $selectedFlight['payment'] ?? [];

// حساب المبلغ الإجمالي
        $totalAmount = $selectedFlight['price']['grandTotal'] ?? 0;

// تمرير البيانات للعرض
        return view('flights.new-payment', compact(
            'selectedFlight',
            'countries',
            'paymentInfo',
            'totalAmount'
        ));
    }

    /**
     * معالجة بيانات الدفع وتخزينها في الجلسة وإرسال إيميل التأكيد
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePayment(Request $request)
    {
        // التحقق من البيانات المدخلة
        $validated = $request->validate([
            'cardType'       => 'required|in:visa,mastercard,amex,discover',
            'cardNumber'     => 'required',
            'expiryMonth'    => 'required|numeric|min:1|max:12',
            'expiryYear'     => 'required|numeric|min:' . date('Y'),
            'cvv'            => 'required|numeric',
            'cardHolderName' => 'required|min:3',
        ]);

        // إضافة بيانات الدفع إلى الجلسة
        $this->addDataToSelectedFlight([
            'payment'        => $validated,
            'payment_status' => 'pending',
            'payment_date'   => now()->toDateTimeString(),
        ]);

        // إنشاء رقم مرجعي للحجز
        $bookingReference = 'BOOK-' . strtoupper(substr(uniqid(), -8));

        // إضافة رقم الحجز والتاريخ إلى بيانات الرحلة
        $this->addDataToSelectedFlight([
            'booking_reference' => $bookingReference,
            'booking_date'      => now()->toDateTimeString(),
            'booking_status'    => 'confirmed',
        ]);

        // الحصول على البيانات المحدثة بعد إضافة معلومات الحجز
        $selectedFlight = $this->getSelectedFlight();

        try {
            $data = $this->prepareConfirmationData();

            $recipientEmail = $data['selectedFlight']['contact']['email'] ?? 'recipient@example.com';
            Mail::to($recipientEmail)->send(new MyTestMail($data));

            // التوجيه إلى صفحة تأكيد الحجز مع رسالة نجاح
            return redirect()->route('flight.confirm')->with('success', 'Booking confirmed and confirmation email sent successfully!');
        } catch (\Exception $e) {
            dd($e->getMessage());

            // تسجيل الخطأ
            Log::error('Email sending failed: ' . $e->getMessage());

            // التوجيه إلى صفحة تأكيد الحجز مع رسالة تحذير
            return redirect()->route('flight.confirm')->with('warning', 'Booking confirmed but we could not send the confirmation email. Please check your email address.');
        }
    }

    /**
     * عرض صفحة تأكيد الحجز
     *
     * @return \Illuminate\View\View
     */
    public function confirm()
    {
        // الحصول على بيانات الرحلة المحددة
        $selectedFlight = $this->getSelectedFlight();

        // التحقق من وجود رحلة محددة وبيانات المسافرين والدفع
        if (! $selectedFlight) {
            return redirect()->route('index')->with('error', 'Please select a flight first');
        }

        if (! isset($selectedFlight['passengers'])) {
            return redirect()->route('flight.passengers')->with('error', 'Please Enter Passengers first');
        }

        if (! isset($selectedFlight['payment'])) {
            return redirect()->route('flight.payment')->with('error', 'Please Enter Payment first');
        }

        // إنشاء رقم مرجعي للحجز
        $bookingReference = 'BOOK-' . strtoupper(substr(uniqid(), -8));

        // إضافة رقم الحجز والتاريخ إلى بيانات الرحلة
        $this->addDataToSelectedFlight([
            'booking_reference' => $bookingReference,
            'booking_date'      => now()->toDateTimeString(),
            'booking_status'    => 'confirmed',
        ]);

        // الحصول على البيانات المحدثة بعد إضافة معلومات الحجز
        $selectedFlight = $this->getSelectedFlight();

        return view('flights.confirm', [
            'bookingReference' => $bookingReference,
            'selectedFlight'   => $selectedFlight,
        ]);
    }

//     public function confirmation()
//     {
//         $selectedFlight = $this->getSelectedFlight();
//         $departureTime  = $selectedFlight['itineraries'][0]['segments'][0]['departure']['at'] ?? '';
//         $datetime       = \Carbon\Carbon::parse($departureTime);

//         $originCity = $selectedFlight['originCity'] ?? '';
//         $cityName   = '';
//         $cityCode   = '';

// // Extract city name (text in parentheses)
//         if (strpos($originCity, '(') !== false && strpos($originCity, ')') !== false) {
//             preg_match('/\((.*?)\)/', $originCity, $matches);
//             $cityName = isset($matches[1]) ? trim($matches[1]) : '';
//         }

// // Extract city code (after comma)
//         if (strpos($originCity, ',') !== false) {
//             $parts    = explode(',', $originCity);
//             $cityCode = isset($parts[1]) ? trim($parts[1]) : '';
//         }

//         return view('emails.booking-confirmation', [
//             'selectedFlight' => $selectedFlight,
//             'datetime'       => $datetime,
//             'cityName'       => $cityName,
//             'cityCode'       => $cityCode,
//         ]);
//     }

    public function explorePlaces()
    {
        return view('explore-places');
    }

    public function sendMail(Request $request)
    {
        // Get the selected flight data from session
        $selectedFlight = $this->getSelectedFlight();

        // Check if we have the necessary data
        if (! $selectedFlight) {
            // Return a direct response instead of redirecting
            if ($request->ajax()) {
                return response()->json(['error' => 'Cannot send email: Missing booking information'], 400);
            }
            return back()->with('error', 'Cannot send email: Missing booking information');
        }

        // Get recipient email from the booking data or use a default
        $recipientEmail = $selectedFlight['contact']['email'] ?? 'recipient@example.com';

        try {
            // Log what we're about to do
            Log::info('Attempting to send email to: ' . $recipientEmail);

            // Send email with the selected flight data directly
            Mail::to($recipientEmail)->send(new MyTestMail($selectedFlight));

            // Return a direct response instead of redirecting
            if ($request->ajax()) {
                return response()->json(['success' => 'Booking confirmation email sent successfully!']);
            }

            // If this is the confirmation page, add a flash message but don't redirect
            if ($request->is('*/confirm') || $request->is('*/confirm/*')) {
                session()->flash('success', 'Booking confirmation email sent successfully!');
                return view('flights.confirm', [
                    'bookingReference' => $selectedFlight['booking_reference'] ?? 'UNKNOWN',
                    'selectedFlight'   => $selectedFlight,
                    'emailSent'        => true,
                ]);
            }

            return back()->with('success', 'Booking confirmation email sent successfully!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Email sending failed: ' . $e->getMessage());

            // Return a direct response instead of redirecting
            if ($request->ajax()) {
                return response()->json(['error' => 'Failed to send email: ' . $e->getMessage()], 500);
            }
            return back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    public function aboutUs()
    {
        return view('about-us');
    }
    public function contactUs()
    {
        return view('contact-us');
    }

    public function prepareConfirmationData()
    {
        $selectedFlight = $this->getSelectedFlight();
        $departureTime  = $selectedFlight['itineraries'][0]['segments'][0]['departure']['at'] ?? '';
        $datetime       = \Carbon\Carbon::parse($departureTime);

        $originCity = $selectedFlight['originCity'] ?? '';
        $cityName   = '';
        $cityCode   = '';

// Extract city name (text in parentheses)
        if (strpos($originCity, '(') !== false && strpos($originCity, ')') !== false) {
            preg_match('/\((.*?)\)/', $originCity, $matches);
            $cityName = isset($matches[1]) ? trim($matches[1]) : '';
        }

// Extract city code (after comma)
        if (strpos($originCity, ',') !== false) {
            $parts    = explode(',', $originCity);
            $cityCode = isset($parts[1]) ? trim($parts[1]) : '';
        }

        return [
            'selectedFlight' => $selectedFlight,
            'datetime'       => $datetime,
            'cityName'       => $cityName,
            'cityCode'       => $cityCode,
            'flightData'     => session('flight_search', []),
        ];
    }
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            Mail::to($request->email)->send(new MyTestMail([
                'type'  => 'subscription',
                'email' => $request->email,
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing!',
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to subscribe. Please try again.',
            ], 500);
        }
    }

}
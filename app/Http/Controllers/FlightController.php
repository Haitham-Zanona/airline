<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index()
    {

        return view('index');
    }

    public $client_id     = '3JoLZTH90MfQWAf04VVo8tgRi4Ke8sH3';
    public $client_secret = 'lDoYhnuI3vZPXy6f';

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
        // dd($request->all());
        $departureDate = Carbon::parse($request->departureDate)->format('Y-m-d');
        $returnDate    = $request->has('returnDate') ? Carbon::parse($request->returnDate)->format('Y-m-d') : null;

        $token = $this->get_token();

        $travelers = "";
        for ($i = 1; $i <= request()->adult; $i++) {
            $travelers .= '
                {
                    "id": "' . $i . '",
                    "travelerType": "ADULT",
                    "fareOptions": [
                        "STANDARD"
                    ]
                }' . (($i != request()->adult) ? ',' : '') . '
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

        if (request()->is_two_way == 1) {
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
                    "maxFlightOffers": 2,
                    "flightFilters": {
                        "cabinRestrictions": [
                            {
                                "cabin": "BUSINESS",
                                "coverage": "MOST_SEGMENTS",
                                "originDestinationIds": [
                                    "1"
                                ]
                            }
                        ],
                        "carrierRestrictions": {
                            "excludedCarrierCodes": [
                                "AA",
                                "TP",
                                "AZ"
                            ]
                        }
                    }
                }
            }',
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'X-HTTP-Method-Override: GET',
                'Authorization: Bearer ' . $token . '',
            ],
        ]);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($curl);

        curl_close($curl);
        // dd($response);
        dd(json_decode($response));

        return json_decode($response)->data;
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

}
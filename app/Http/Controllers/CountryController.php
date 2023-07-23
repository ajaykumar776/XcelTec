<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CountryController extends Controller
{

    public function getStates($countryCode)
    {
        $client = new Client();
        $response = $client->get("https://restcountries.com/v3.1/alpha/{$countryCode}");
        $countryData = json_decode($response->getBody(), true);
        $states = $countryData['states'] ?? [];
        return response()->json($states);
    }

    public function getCities($countryCode, $stateCode)
    {
        $client = new Client();
        $response = $client->get("https://restcountries.com/v3.1/alpha/{$countryCode}/{$stateCode}");
        $stateData = json_decode($response->getBody(), true);
        $cities = $stateData['cities'] ?? [];
        return response()->json($cities);
    }
}

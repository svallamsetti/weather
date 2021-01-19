<?php

declare(strict_types=1);

namespace App\WeatherRepository;

use App\Helpers\APIResponseHelper;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class WeatherRESTImplementation implements WeatherContract{

    const UNITS="imperial";
    /**
     * @var APIResponseHelper
     */
    private $APIResponseHelper;

    /**
     * WeatherRESTImplementation constructor.
     * @param APIResponseHelper $APIResponseHelper
     */
    public function __construct(APIResponseHelper $APIResponseHelper)
    {
        $this->APIResponseHelper = $APIResponseHelper;
    }


    public function retrieveWeatherByZipCode(string $zipCode) : Array
    {
        $response =  Http::get(config('weather.api'), [
            "zip" => $zipCode,
            "appid" => config('weather.apiKey'),
            "units" => self::UNITS
        ]);
        return json_decode($response->body(), true);
    }
}

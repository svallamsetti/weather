<?php
namespace App\WeatherRepository;

interface WeatherContract{
    public function retrieveWeatherByZipCode(string $zipCode) : Array;
}

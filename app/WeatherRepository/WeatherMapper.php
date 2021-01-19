<?php


namespace App\WeatherRepository;


use App\Domain\Weather\WeatherByZipCode;
use App\Exceptions\WeatherAPIException;
use App\SearchHistoryRepository\SearchHistoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class WeatherMapper
{
    /**
     * @var WeatherContract
     */
    private $weatherContract;
    /**
     * @var SearchHistoryContract
     */
    private $searchHistoryContract;


    /**
     * WeatherMapper constructor.
     * @param WeatherContract $weatherContract
     * @param SearchHistoryContract $searchHistoryContract
     */
    public function __construct(WeatherContract $weatherContract, SearchHistoryContract $searchHistoryContract)
    {
        $this->weatherContract = $weatherContract;
        $this->searchHistoryContract = $searchHistoryContract;
    }

    public function retrieveWeatherByZipCode(string $zipCode) : WeatherByZipCode
    {
        $response = $this->weatherContract->retrieveWeatherByZipCode($zipCode);
        if(isset($response["cod"])){
            $statusCode = $response['cod'];
            if($statusCode >= 400){
                throw new WeatherAPIException($response['message']);
            }
            if($statusCode === 200){
                return WeatherByZipCode::make($zipCode, $response['main']['temp'], Carbon::createFromTimestamp($response['dt'])->toDayDateTimeString(), $response['name']);
            }
        }
    }

    public function createSearchHistory(string $ip, WeatherByZipCode $weatherByZipCode) : Collection
    {
        $this->searchHistoryContract->createRecords([
            'visitor' =>$ip,
            'location' =>$weatherByZipCode->getLocation(),
            'temperature' =>$weatherByZipCode->getTemperature(),
            'zipCode' =>$weatherByZipCode->getZipCode(),
            'dayTime' =>$weatherByZipCode->getDayTime(),
            'created_at' => Carbon::now(),
        ]);
        return $this->searchHistoryContract->all();
    }

    public function createInvalidSearchHistoryRecord(string $ip, string $zipCode) : Collection
    {
        $this->searchHistoryContract->createRecords([
            'visitor' => $ip,
            'location' => null,
            'temperature' => null,
            'zipCode' => $zipCode,
            'dayTime' => null,
            'created_at' => Carbon::now(),
        ]);
        return $this->searchHistoryContract->all();
    }

    public function getSearchHistory(): Collection
    {
        return $this->searchHistoryContract->all();
    }
}

<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\WeatherAPIException;
use App\WeatherRepository\WeatherMapper;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * @var WeatherMapper
     */
    private $weatherMapper;

    /**
     * WeatherController constructor.
     * @param WeatherMapper $weatherMapper
     */
    public function __construct(WeatherMapper $weatherMapper)
    {
        $this->weatherMapper = $weatherMapper;
    }

    public function index()
    {
        $searchHistory = $this->weatherMapper->getSearchHistory();
        return view('welcome', ['searchHistory' => $searchHistory]);
    }

    public function retrieveWeatherByZipCode(Request $request)
    {
        $validatedData = $request->validate([
            'zipCode' => 'required|min:5|max:5',
        ]);
        $zipCode = $validatedData['zipCode'];
        try {
            $weatherByZipCode = $this->weatherMapper->retrieveWeatherByZipCode($zipCode);
            $searchHistory = $this->weatherMapper->createSearchHistory($request->ip(), $weatherByZipCode);
        } catch (WeatherAPIException $e) {
            $searchHistory = $this->weatherMapper->createInvalidSearchHistoryRecord($request->ip(), $zipCode);
            return view('welcome', ['exception' => $e->getMessage() .' for Zip Code: ' .$zipCode, 'searchHistory' => $searchHistory]);
        }
        return view('welcome', ['weatherByZipCode' => $weatherByZipCode, 'searchHistory' => $searchHistory]);
    }
}

<?php


namespace Tests\Unit\Weather;


use App\Domain\Weather\WeatherByZipCode;
use App\Exceptions\WeatherAPIException;
use App\Models\SearchHistory;
use App\WeatherRepository\WeatherMapper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherMapperTest extends TestCase
{
    use RefreshDatabase;
    public function testCanSendWeatherAPIResponse() : void
    {
        $mockResponse = ['main' => [
            'temp' => '34.5'
        ], 'name' => 'Mason', 'dt' => '1610914925', 'cod' => 200];
        Http::fake([
            'api.openweathermap.org/*' => Http::response(
                $mockResponse
            )
        ]);
        $weatherMapper = resolve(WeatherMapper::class);
        $response = $weatherMapper->retrieveWeatherByZipCode('45040');
        $this->assertInstanceOf(WeatherByZipCode::class, $response);
    }

    public function testWeatherAPIExceptionCanBeThrown() : void
    {
        $mockResponse = ['message' => 'zip code not found', 'cod' => 404];
        Http::fake([
            'api.openweathermap.org/*' => Http::response(
                $mockResponse
            )
        ]);
        $weatherMapper = resolve(WeatherMapper::class);
        $this->expectException(WeatherAPIException::class);
        $weatherMapper->retrieveWeatherByZipCode('45040');
    }

    public function testCanCreateValidHistoryRecord(): void
    {
        $this->assertCount(0, SearchHistory::all());
        $weatherByZipCode = WeatherByZipCode::make('45040','34.5', 'Sun, Jan 17, 4:50 PM', 'Mason');
        $weatherMapper = resolve(WeatherMapper::class);
        $weatherMapper->createSearchHistory('127.0.0.1', $weatherByZipCode);
        $this->assertCount(1, SearchHistory::all());

    }
    public function testCanCreateInvalidSearchHistoryRecord(): void
    {
        $this->assertCount(0, SearchHistory::all());
        $weatherMapper = resolve(WeatherMapper::class);
        $weatherMapper->createInvalidSearchHistoryRecord('127.0.0.1', '45056');
        $this->assertCount(1, SearchHistory::all());
        $this->assertSame('45056', SearchHistory::first()->zipCode);
        $this->assertNull(SearchHistory::first()->location);

    }
}

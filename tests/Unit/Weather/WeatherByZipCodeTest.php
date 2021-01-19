<?php


namespace Tests\Unit\Weather;


use App\Domain\Weather\WeatherByZipCode;
use App\WeatherRepository\WeatherRESTImplementation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherByZipCodeTest extends TestCase
{
    public function testCanCreateWeatherByZipCodeObject(): void
    {
        $mockResponse = ['main' => [
            'temp' => '34.5'
        ], 'name' => 'Mason', 'dt' => '1610914925', 'cod' => '200'];
        Http::fake([
            'api.openweathermap.org/*' => Http::response(
                $mockResponse
            )
        ]);
        $weatherContract = resolve(WeatherRESTImplementation::class);
        $response = $weatherContract->retrieveWeatherByZipCode('45040');
        $weatherByZipCode = WeatherByZipCode::make('45040', $response['main']['temp'], Carbon::createFromTimestamp($response['dt'])->toDayDateTimeString(), $response['name']);
        $this->assertInstanceOf(WeatherByZipCode::class, $weatherByZipCode);
        $this->assertSame('34.5', $weatherByZipCode->getTemperature());
        $this->assertSame('Sun, Jan 17, 2021 3:22 PM', $weatherByZipCode->getDayTime());
        $this->assertSame('Mason', $weatherByZipCode->getLocation());
        $this->assertSame('45040', $weatherByZipCode->getZipCode());
    }
}

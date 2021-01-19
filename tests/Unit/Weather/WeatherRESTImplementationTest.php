<?php

namespace Tests\Unit\Weather;

use App\WeatherRepository\WeatherRESTImplementation;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherRESTImplementationTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCanRetrieveWeatherByZipCode(): void
    {
        $expectedResponse = ['main' => [
            'temp' => '34.5'
        ], 'name' => 'Mason', 'dt' => '1610914925', 'cod' => '200'];
        Http::fake([
            'api.openweathermap.org/*' => Http::response(
               $expectedResponse
            )
        ]);
        $weatherContract = resolve(WeatherRESTImplementation::class);
        $this->assertSame($expectedResponse, $weatherContract->retrieveWeatherByZipCode('45040'));
    }
}

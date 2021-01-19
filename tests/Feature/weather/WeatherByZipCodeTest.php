<?php


namespace Tests\Feature\weather;

use App\Models\SearchHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherByZipCodeTest extends TestCase
{
    use RefreshDatabase;
    public function testCanSeeWeatherView(): void
    {
        $response = $this->get('/weather');
        $response->assertStatus(200);
        $response->assertSee('Weather App');
    }

    public function testCanGetWeatherByZipCode(): void
    {
        $mockResponse = ['main' => [
            'temp' => '34.5'
        ], 'name' => 'Mason', 'dt' => '1610914925', 'cod' => 200];
        Http::fake([
            'api.openweathermap.org/*' => Http::response(
                $mockResponse
            )
        ]);
        $this->assertCount(0, SearchHistory::all());
        $response = $this->post('/weather', [
            'zipCode' => '45040'
        ]);
        $this->assertCount(1, SearchHistory::all());
        $response->assertStatus(200);
        $response->assertSee('Mason');
        $response->assertSee('34.5');
        $response->assertSee('45040');
    }

    public function testValidationWorks(): void
    {
        $this->assertCount(0, SearchHistory::all());
        $response = $this->post('/weather', [
            'zipCode' => '450407'
        ]);
        $this->assertCount(0, SearchHistory::all());
        $response->assertStatus(302);
        $response->assertSessionHasErrors('zipCode');
    }
    public function testExceptionWorks(): void
    {
        $mockResponse = ['cod' => 404, 'message' => 'city not found'];
        Http::fake([
            'api.openweathermap.org/*' => Http::response(
                $mockResponse
            )
        ]);
        $this->assertCount(0, SearchHistory::all());
        $response = $this->post('/weather', [
            'zipCode' => '96201'
        ]);
        $this->assertCount(1, SearchHistory::all());
        $response->assertSeeText('city not found for Zip Code: 96201');
    }
}

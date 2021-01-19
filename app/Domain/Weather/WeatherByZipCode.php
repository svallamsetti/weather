<?php
declare(strict_types=1);

namespace App\Domain\Weather;


class WeatherByZipCode
{
    /**
     * @var string
     */
    private $temperature;
    /**
     * @var string
     */
    private $dayTime;
    /**
     * @var string
     */
    private $location;
    /**
     * @var string
     */
    private $zipCode;


    /**
     * WeatherByZipCode constructor.
     * @param string $zipCode
     * @param string $temperature
     * @param string $dayTime
     * @param string $location
     */
    protected function __construct(string $zipCode, string $temperature, string $dayTime, string $location)
    {

        $this->temperature = $temperature;
        $this->dayTime = $dayTime;
        $this->location = $location;
        $this->zipCode = $zipCode;
    }

    /**
     * @param string $zipCode
     * @param string $temperature
     * @param string $dayTime
     * @param string $location
     * @return static
     */
    public static function make(string $zipCode, string $temperature, string $dayTime, string $location): self
    {
        return new WeatherByZipCode($zipCode, $temperature, $dayTime, $location);
    }

    /**
     * @return string
     */
    public function getTemperature(): string
    {
        return $this->temperature;
    }

    /**
     * @return string
     */
    public function getDayTime(): string
    {
        return $this->dayTime;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }


}

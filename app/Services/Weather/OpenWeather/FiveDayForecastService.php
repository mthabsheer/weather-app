<?php

namespace App\Services\Weather\OpenWeather;

use App\Models\Cities;
use App\Services\Weather\Contracts\WeatherApiContracts;
use Exception;

class FiveDayForecastService
{
    /**
     * @var string
     */
    private string $baseUrl;

    /**
     * @var OpenWeatherApiService
     */
    private OpenWeatherApiService $apiService;

    public function __construct()
    {
        $this->baseUrl = config('services.openweather.base_url') . '/data/2.5/forecast';
    }

    /**
     * @param Cities $city
     * 
     * @return mixed
     */
    public function getForecastForCity(Cities $city): mixed
    {
        return (new OpenWeatherApiService($this->baseUrl, [
            'lat' => $city->lat,
            'lon' => $city->lng,
        ]))->handle();
    }
}

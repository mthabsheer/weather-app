<?php

namespace App\Services\Weather\OpenWeather;

use Exception;
use App\Models\Cities;
use Illuminate\Support\Str;
use App\Http\Resources\CityResource;
use Illuminate\Support\Facades\Cache;
use App\Services\Weather\Contracts\WeatherApiContracts;

class OpenWeatherService implements WeatherApiContracts
{

    /**
     * @param Cities $city
     * 
     * @return array|Exception
     */
    public function getForecastForSingleCity(Cities $city): array|Exception
    {
        try {

            $cashKey = 'w-' . Str::of($city->name)->slug('-');

            $response = Cache::remember($cashKey, config('services.api_cache'), function () use ($city) {
                return (new FiveDayForecastService())->getForecastForCity($city);
            });

            return [
                'name' => $city->name,
                'weather_data' => new CityResource($response->getResponseData()),
            ];
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @return array|Exception
     */
    public function getForecastForAllCity(): array|Exception
    {
        $cityData = [];
        $cities = Cities::cursorPaginate(config('services.pagination'));

        foreach ($cities as $key => $city) {
            $cityData[] = $this->getForecastForSingleCity($city);
        }

        return [
            'data' => $cityData,
            'current_item_count' => $cities->count(),
            'next_page_links' => $cities->nextPageUrl(),
            'previous_page_links' => $cities->previousPageUrl(),
        ];
    }
}

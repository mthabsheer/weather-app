<?php
namespace App\Services\Weather\Contracts;

use Exception;
use App\Models\Cities;

interface WeatherApiContracts{
    public function getForecastForSingleCity( Cities $city);
    public function getForecastForAllCity(): array|Exception;
}
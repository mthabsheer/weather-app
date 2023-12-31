<?php

namespace App\Http\Controllers\Api;

use App\Contracts\CitiesRepositoryContract;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\CityRequest;
use App\Models\Cities;
use App\Services\Weather\Contracts\WeatherApiContracts;

class CitiesController extends BaseController
{

    public function index(WeatherApiContracts $weatherService)
    {

        return $this->sendResponse('Success', $weatherService->getForecastForAllCity());
    }

    public function show(string $name, WeatherApiContracts $weatherService, CitiesRepositoryContract $cityRepository)
    {
        try {

            if (!$city = $cityRepository->getAcitveCityByName($name)) {
                return $this->sendError('No city found');
            }

            $response = $weatherService->getForecastForSingleCity($city);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse('Success', $response);
    }


    public function store(CityRequest $request, WeatherApiContracts $weatherService, CitiesRepositoryContract $cityRepository)
    {
        try {

            $cityModel = $cityRepository->saveCity($request);

            return $this->sendResponse('Success', $cityModel);
        } catch (\Exception $e) {
            
            return $this->sendError($e->getMessage());
        }
    }
}

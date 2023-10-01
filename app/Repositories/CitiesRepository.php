<?php

namespace App\Repositories;

use App\Models\Cities;
use App\Http\Requests\CityRequest;
use App\Contracts\CitiesRepositoryContract;
use Exception;

class CitiesRepository implements CitiesRepositoryContract
{
    public function saveCity(CityRequest $request)
    {
        try {
            $city = Cities::create([
                'name' => $request->name,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'status' => Cities::STATUS_ENABLED
            ]);

            return $city;
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                throw new Exception('City already exists', 400);
            }

            throw $e;
        }
    }
}

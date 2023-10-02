<?php

namespace App\Repositories;

use App\Models\Cities;
use App\Http\Requests\CityRequest;
use App\Contracts\CitiesRepositoryContract;
use Exception;

class CitiesRepository implements CitiesRepositoryContract
{
    /**
     * @param CityRequest $request
     * 
     * @return Cities
     */
    public function saveCity(CityRequest $request): Cities
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

    /**
     * @param string $name
     * 
     * @return Cities|null
     */
    public function getAcitveCityByName(string $name): Cities|null
    {
        return Cities::where('name', $name)
        ->active()
        ->first();
    }
}

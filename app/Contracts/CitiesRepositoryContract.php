<?php
namespace App\Contracts;

use App\Http\Requests\CityRequest;

interface CitiesRepositoryContract
{
    public function saveCity(CityRequest $request);
}
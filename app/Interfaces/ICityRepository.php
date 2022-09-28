<?php

namespace App\Interfaces;

use App\Http\Requests\CityRequest;

interface ICityRepository
{
    public function create(CityRequest $request);
    public function updateCityById($request, int $id);
    public function findCityById(int $id);
    public function deleteCityById(int $id);
    public function findAllCities();
}

<?php

namespace App\Repositories;

use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Interfaces\ICityRepository;

class CityRepository implements ICityRepository
{
    private $city;

    public function __construct(City $city)
    {
        $this->city = $city;
    }

    public function create($request)
    {
        return $this->city::create($request);
    }

    public function updateCityById($request, int $id)
    {
        $cityExists = $this->findCityById($id);

        if (!$cityExists) return false;

        return $this->city::where('id', $id)->update($request);
    }

    public function findCityById($id)
    {
        $cityExists = $this->city::find($id);

        return $cityExists;
    }

    public function deleteCityById($id)
    {
        $cityExists = $this->findCityById($id);

        if (!$cityExists) return false;

        return $this->city::destroy($id);
    }

    public function findAllCities()
    {
        return $this->city::all();
    }
}

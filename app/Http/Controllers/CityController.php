<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Interfaces\ICityRepository;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    private $cityRepository, $validationRules = [];
    public function __construct(ICityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->validationRules = [
            'city_name' => 'required|unique:cities',
            'latitude' => 'required',
            'longitude' => 'required'
        ];
    }
    /**
     * Listar todas a Cidades.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->cityRepository->findAllCities();
    }

    /**
     * Cadastrar uma nova cidade.
     *
     * @param  App\Http\Requests\CityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $validator = Validator::make($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $this->cityRepository->create($request->all());

        return json_encode([
            "message" => "Cidade cadastrada com sucesso.",
            "success" => true
        ]);
    }

    /**
     * Atualizar cidades.
     *
     * @param  App\Http\Requests\CityRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, $id)
    {
        $validator = Validator::make($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $city = $this->cityRepository->updateCityById($request->all(), $id);

        if (!$city) {
            return response()->json(["error" => "Cidade inexistente"], 400);
        }

        return response()->json([
            "message" => "Cidade atualizada com sucesso",
            "success" => true
        ], 201);
    }

    /**
     * Listar Cidade pelo id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = $this->cityRepository->findCityById($id);

        if (!$city) {
            return response()->json(["error" => "Cidade inexistente"]);
        }

        return response()->json([
            "id" => $city->id,
            "cidade" => $city->city_name,
            "coords" => [
                "latitude" => $city->latitude,
                "longitude" => $city->longitude
            ],
            "postos" => $city->posts,
            "updated_at" => date_format($city->updated_at, 'Y-m-d H:m'),
            "created_at" => date_format($city->created_at, 'Y-m-d H:m')
        ]);
    }

    /**
     * Remover Cidade pelo id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = $this->cityRepository->deleteCityById($id);

        if (!$city) {
            return response()->json(["error" => "Cidade inexistente"]);
        }

        return response()->json([
            "message" => "Cidade removida com sucesso.",
            "success" => true
        ]);
    }
}

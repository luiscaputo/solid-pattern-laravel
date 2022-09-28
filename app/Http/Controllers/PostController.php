<?php

namespace App\Http\Controllers;

use App\Interfaces\ICityRepository;
use App\Interfaces\IPostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    private $postRepository, $cityRepository, $validationRules = [];
    public function __construct(
        IPostRepository $postRepository,
        ICityRepository $cityRepository
    ) {
        $this->postRepository = $postRepository;
        $this->cityRepository = $cityRepository;
        $this->validationRules = [
            'city_id' => 'required',
            'reservoir' => 'required|unique:posts',
            'latitude' => 'required',
            'longitude' => 'required'
        ];
    }
    /**
     * Listar todas a Postos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->postRepository->findAllPosts();
    }

    /**
     * Cadastrar uma nova posto.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $city = $this->cityRepository->findCityById($request->all()['city_id']);

        if (!$city) {
            return response()->json(["error" => "Cidade inexistente"]);
        }

        $this->postRepository->create($request->all());

        return response()->json([
            "message" => "Posto cadastrado com sucesso.",
            "success" => true
        ]);
    }

    /**
     * Atualizar posto.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->validationRules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $post = $this->postRepository->updatePostById($request->all(), $id);

        if (!$post) {
            return response()->json(["error" => "Posto inexistente"], 400);
        }

        return response()->json([
            "message" => "Posto atualizado com sucesso",
            "success" => true
        ], 201);
    }

    /**
     * Listar Posto pelo id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postRepository->findPostById($id);

        if (!$post) {
            return response()->json(["error" => "Posto inexistente"]);
        }

        return response()->json([
            "id" => $post->id,
            "reservatorio" => $post->reservoir,
            "coords" => [
                "latitude" => $post->latitude,
                "longitude" => $post->longitude
            ],
            "updated_at" => date_format($post->updated_at, 'Y-m-d H:m'),
            "created_at" => date_format($post->created_at, 'Y-m-d H:m')
        ]);
    }


    /**
     * Remover Posto pelo id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->postRepository->deletePostById($id);

        if (!$post) {
            return response()->json(["error" => "Posto inexistente"]);
        }

        return response()->json([
            "message" => "Posto removido com sucesso.",
            "success" => true
        ]);
    }
}

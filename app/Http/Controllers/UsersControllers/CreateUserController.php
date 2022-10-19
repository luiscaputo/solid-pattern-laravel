<?php

namespace App\Http\Controllers\UsersControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Modules\Users\UseCases\CreateUser\CreateUserUseCase;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController extends Controller
{
  private $useCase;

  public function __construct(CreateUserUseCase $useCase)
  {
    $this->useCase = $useCase;
  }

  /**
   * Create New User.
   *
   * @param  App\Http\Requests\UserRequest  $request
   * @return \Illuminate\Http\Response
   */

  public function handle(UserRequest $request)
  {
    try {
      $user = $this->useCase->execute($request->all());
      return response()->json([
        'success' => true,
        'data' => $user,
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }
}

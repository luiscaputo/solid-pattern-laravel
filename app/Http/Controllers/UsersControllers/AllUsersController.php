<?php

namespace App\Http\Controllers\UsersControllers;

use App\Http\Controllers\Controller;
use App\Modules\Users\Repositories\UseCases\AllUsers\AllUsersUseCase;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class AllUsersController extends Controller
{
  private $useCase;

  public function __construct(AllUsersUseCase $useCase)
  {
    $this->useCase = $useCase;
  }

  /**
   * All Users.
   *
   * @return \Illuminate\Http\Response
   */

  public function handle()
  {
    try {
      $user = $this->useCase->execute();
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

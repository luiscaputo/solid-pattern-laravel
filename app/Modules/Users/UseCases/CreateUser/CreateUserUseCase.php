<?php

namespace App\Modules\Users\UseCases\CreateUser;

use App\Modules\Users\Repositories\IUserRepository;
use Illuminate\Support\Facades\Hash;

class CreateUserUseCase
{
  private $repository;

  public function __construct(IUserRepository $repository)
  {
    $this->repository = $repository;
  }
  public function execute($request)
  {
    $request->password = Hash::make($request->password);

    $user = $this->repository->create($request);

    return $user;
  }
}

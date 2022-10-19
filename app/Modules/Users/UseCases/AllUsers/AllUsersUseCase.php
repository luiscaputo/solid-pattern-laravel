<?php

namespace App\Modules\Users\Repositories\UseCases\AllUsers;

use App\Modules\Users\Repositories\IUserRepository;

class AllUsersUseCase
{
  private $repository;

  public function __construct(IUserRepository $repository)
  {
    $this->repository = $repository;
  }
  public function execute()
  {
    $users = $this->repository->findAllUsers();

    return $users;
  }
}

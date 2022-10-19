<?php

namespace App\Modules\Users\Repositories\Implementations;

use App\Models\User;
use App\Modules\Users\Repositories\IUserRepository;

class UserRepositoryImpl implements IUserRepository
{
  private $model;

  public function __construct(User $model)
  {
    $this->model = $model;
  }

  public function create($request)
  {
    return $this->model::create($request);
  }

  public function updateUser($request, int $id)
  {
    return $this->model::where('id', $id)->update($request);
  }

  public function findUserById(int $id)
  {
    $user = $this->model::find($id);
    return $user;
  }

  public function deleteUserById(int $id)
  {
    return $this->model::destroy($id);
  }

  public function findAllUsers()
  {
    return $this->model::all();
  }
}

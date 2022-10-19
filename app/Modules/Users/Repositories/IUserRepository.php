<?php

namespace App\Modules\Users\Repositories;

use App\Http\Requests\UserRequest;

interface IUserRepository
{
  public function create(UserRequest $request);
  public function updateUser($request, int $id);
  public function findUserById(int $id);
  public function deleteUserById(int $id);
  public function findAllUsers();
}

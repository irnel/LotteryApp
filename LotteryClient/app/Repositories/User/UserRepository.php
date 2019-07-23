<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository implements UserRepositoryInterface
{
  public function __construct()
  {

  }

  public function all()
  {
    return User::all();
  }

  public function create(array $user)
  {
    return User::create($user);
  }

  public function update(array $user, $id)
  {
    return User::where('id', $id)
      ->update($user);
  }

  public function delete($id)
  {

  }

  public function find($id)
  {
    return User::find($id);
  }

  public function getEventsByUserId($userId)
  {
      return User::find($userId)->events;
  }
}

<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository implements UserRepositoryInterface
{
  protected $model;

  public function __construct(User $user) {
    $this->model = $user;
  }

  public function all()
  {
    $this->model->all();
  }

  public function create(array $user)
  {
    return $this->model->create($user);
  }

  public function update(array $user, $id)
  {
    return $this->model->where('id', $id)
      ->update($user);
  }

  public function delete($id)
  {
    return $this->model->destroy($id);
  }

  public function find($id)
  {
    return $this->model->find($id);
  }

  public function getEventsByUserId($userId)
  {
      return $this->find($userId)->events;
  }
}

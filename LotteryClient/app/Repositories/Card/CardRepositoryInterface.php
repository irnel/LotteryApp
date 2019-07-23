<?php

namespace App\Repositories\Card;

use App\Repositories\Base\RepositoryInterface;

interface CardRepositoryInterface extends RepositoryInterface
{
    public function updateOrCreateCard(array $data, array $params);
}


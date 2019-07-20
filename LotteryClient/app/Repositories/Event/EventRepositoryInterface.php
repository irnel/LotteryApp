<?php

namespace App\Repositories\Event;

use App\Repositories\Base\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection as IlluminateCollection;

interface EventRepositoryInterface extends RepositoryInterface
{
    public function getCardsByEventId($eventId);

    public function getEventsByUserId($userId);

    public function myEvents();

    public function updateOrCreateEvent(array $event, array $params);
}

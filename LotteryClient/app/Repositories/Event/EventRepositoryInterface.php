<?php

namespace App\Repositories\Event;

use App\Repositories\Base\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection as IlluminateCollection;

interface EventRepositoryInterface extends RepositoryInterface
{
    public function getMyCardsByEventId($eventId);

    public function getEventsByUserId($userId);

    public function getEventById($id);

    public function myEvents();

    public function updateOrCreateEvent(array $event, array $params);

    public function getUserEventByEventIdAndCurrentUser($eventId);

    public function getAllUserEventsByEventId($eventId);

    public function createUserEvent(array $data);

    public function updateUserEvent(array $data, $id);
}

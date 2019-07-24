<?php

namespace App\Repositories\Event;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Event;
use App\Models\UserEvent;
use App\Models\Card;

class EventRepository implements EventRepositoryInterface
{
    public function all()
    {
        return Event::all();
    }

    public function create(array $event) {
        return Event::create($event);
    }

    public function update(array $data, $id)
    {
        return Event::where('id', $id)->update($data);
    }

    public function delete($id)
    {

    }

    public function find($id)
    {
        return Event::find($id);
    }

    public function myEvents()
    {
        return auth()->user()->events;
    }

    public function getEventsByUserId($userId)
    {
        return $this->all()->where('user_id', $userId);
    }

    public function getEventById($id)
    {
        return Event::where('id', $id)->first()->users;
    }

    public function getMyCardsByEventId($eventId)
    {
        return Card::where('event_id', $eventId)
            ->where('user_id', auth()->user()->id)
            ->get();
    }

    public function updateOrCreateEvent(array $data, array $params)
    {
        return Event::updateOrCreate($data, $params);
    }

    public function getUserEventByEventIdAndCurrentUser($eventId)
    {
        return UserEvent::all()
            ->where('user_id', auth()->user()->id)
            ->where('event_id', $eventId)
            ->first();
    }

    public function getAllUserEventsByEventId($eventId)
    {
        return UserEvent::where('event_id', $eventId)->get();
    }

    public function createUserEvent(array $data)
    {
        return UserEvent::create($data);
    }

    public function updateUserEvent(array $data, $id)
    {
        return UserEvent::where('id', $id)->update($data);
    }
}

<?php

namespace App\Repositories\Event;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

class EventRepository implements EventRepositoryInterface
{
    public function all()
    {
        return Event::all();
    }

    public function create(array $event) {
        return Event::create([
            'id' => $event['id'],
            'user_id' => auth()->user()->id,
            'start_date' => $event['start_date'],
            'start_time' => $event['start_time'],
            'card_price' => $event['card_price'],
            'award' => $event['award'],
            'event_progress' => $event['event_progress']
        ]);
    }

    public function update(array $event, $id)
    { 

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

    public function getCardsByEventId($eventId)
    {
        return $this->find($eventId)->cards;
    }

    public function updateOrCreateEvent(array $data, array $params)
    {
        return Event::updateOrCreate($data, $params);
    }
}

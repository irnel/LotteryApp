<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Event;
use Illuminate\Support\Collection;
use App\Models\Card;
use Illuminate\Database\Eloquent\Collection as IlluminateCollection;
use App\Helpers\AttributeFormat;

class ApiService implements ApiInterface
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAllAvailableEvents()
    {
        $response = $this->client->get('api/events/available');
        $data = $response->getBody()->getContents();
        $collection = collect(json_decode($data));

        $events = new Collection();

        foreach ($collection as $item) {
            $events->push(new Event([
                'id' => $item->Id,
                'start_date' => $item->StartDate,
                'start_time' => $item->StartTime,
                'card_price' => $item->CardPrice,
                'award' => $item->Award,
                'event_progress' => $item->EventProgress
            ]));
        }

        return $events;
    }

    public function getEventById($id)
    {
        $response = $this->client->get('api/events/'.$id);
        $data = $response->getBody()->getContents();
        $object = json_decode($data);

        return new Event([
            'id' => $object->Id,
            'start_date' => $object->StartDate,
            'start_time' => $object->StartTime,
            'card_price' => $object->CardPrice,
            'award' => $object->Award,
            'event_progress' => $object->EventProgress
        ]);        
    }

    public function getAllAvailableCardsByEventId($eventId)
    {
        $response = $this->client->get('/api/events/'.$eventId.'/cards/available');
        $data = $response->getBody()->getContents();
        $collection = collect(json_decode($data));

        $cards = new IlluminateCollection();

        foreach ($collection as $item) {
            $cards->push(new Card([
                'id' => $item->Id,
                'event_id' => $item->LotteryEventId
            ]));
        }

        return $cards;
    }

    public function getCardById($id)
    {
        $response = $this->client->get('/api/cards/'.$id);
        $data = $response->getBody()->getContents();
        $object = json_decode($data);

        return new Card([
            'id' => $object->Id,
            'event_id' => $object->LotteryEventId
        ]);
    }

    public function updateStatusCard($card)
    {
        // $reponse = $this->client->put('/api/cards');
    }
}

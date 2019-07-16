<?php

namespace App\Services;

use GuzzleHttp\Client;

class ApiService implements ApiInterface
{
    protected $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function getAllAvailableEvents() {
        $response = $this->client->get('/users');
        return $response->getBody()->__toString();
    }

    public function getAllAvailableCardsByEventId($eventId) {

    }
}

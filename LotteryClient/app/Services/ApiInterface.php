<?php

namespace App\Services;

interface ApiInterface
{
    public function getAllAvailableEvents();

    public function getAllClosedEvents();

    public function getEventById($id);

    public function getAllAvailableCardsByEventId($eventId);

    public function getCardById($id);

    public function updateStatusCard(array $card);
}

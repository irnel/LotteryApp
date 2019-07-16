<?php

namespace App\Services;

interface ApiInterface
{
    public function getAllAvailableEvents();

    public function getAllAvailableCardsByEventId($eventId);
}

<?php

namespace App\Http\Controllers\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApiInterface;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Card\CardRepositoryInterface;

class EventController extends Controller
{
    protected $service;
    protected $eventRepository;
    protected $cardRepository;

    public function __construct(
        ApiInterface $service,
        EventRepositoryInterface $eventRepository,
        CardRepositoryInterface $cardRepository)
    {
        $this->middleware('auth');
        $this->service = $service;
        $this->eventRepository = $eventRepository;
        $this->cardRepository = $cardRepository;
    }

    public function myEvents() {
        $events = $this->eventRepository->myEvents();
        return view('my-events')->with('events', $events);
    }

    public function myEventWithCards($eventId) {
        $myEvent = $this->eventRepository->find($eventId);
        $myCards = $this->eventRepository->getMyCardsByEventId($eventId);

        return view('my-cards')
            ->with('event', $myEvent)
            ->with('cards', $myCards);
    }

    public function getAvailableCards($eventId)
    {
        $event = $this->service->getEventById($eventId);
        $cards = $this->service->getAllAvailableCardsByEventId($eventId);

        return view('available-cards')
            ->with('event', $event)
            ->with('cards', $cards);
    }

    // datatable ajax request
    public function getAvailableCardsByEventId($eventId) {
        return datatables()
            ->collection($this->service->getAllAvailableCardsByEventId($eventId))
            ->make(true);
    }

    public function closedEvents()
    {
        return $this->service->getAllClosedEvents();
    }

    public function addCards(Request $request, $eventId) {
        if ($request->has('selected_cards')) {
            $cardsArray = $request->input('selected_cards');

            $event = $this->service->getEventById($eventId);
            // Add event if not exist
            $this->eventRepository->updateOrCreateEvent(
                [
                    'id' => $event->id,
                    'start_date' => $event->start_date,
                    'start_time' => $event->start_time,
                    'card_price' => $event->card_price,
                    'award' => $event->award
                ],
                ['id' => $event->id]
            );

            // Add user event
            if ($this->eventRepository->getUserEventByEventIdAndCurrentUser($event->id) == null)
            {
                $this->eventRepository->createUserEvent([
                    'user_id' => auth()->user()->id,
                    'event_id' => $event->id
                ]);
            }

            // add selected cards
            foreach ($cardsArray as $item) {
                $card = (json_decode($item));
                // external api update card model
                $this->service->updateStatusCard([
                    'Id' => $card->id,
                    'LotteryEventId' => $card->event_id,
                    'IsAvailable' => false
                ]);

                $this->cardRepository->updateOrCreateCard(
                    [
                        'id' => $card->id,
                        'event_id' => $card->event_id,
                        'user_id' => auth()->user()->id
                    ],
                    ['id' => $card->id]
                );
            }

            // success response
            return response()->json(['status' => '200'], 200);
        }
        else {
            // error response
            return response()->json(['status' => '400'], 400);
        }
    }

    public function test()
    {
        return $this->eventRepository->myEvents();
    }
}

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

    public function myCards($eventId) {
        $cards = $this->eventRepository->getCardsByEventId($eventId);
        return view('my-cards')->with('cards', $cards);
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

    public function addCards(Request $request, $id) {
        if ($request->has('selected_cards')) {
            $array = $request->input('selected_cards');

            $model = $this->service->getEventById($id);

            $eventArrayData = [
                'id' => $model['id'],
                'user_id' => auth()->user()->id,
                'start_date' => $model['start_date'],
                'start_time' => $model['start_time'],
                'card_price' => $model['card_price'],
                'award' => $model['award'],
                'event_progress' => $model['event_progress']
            ];

            $this->eventRepository->updateOrCreateEvent($eventArrayData, ['id' => $model['id']]);

            // add available cards selected
            foreach ($array as $cardId) {
                $card = $this->service->getCardById($cardId);
                $cardArrayData = [
                    'id' => $card['id'],
                    'event_id' => $card['event_id'],
                ];

                $this->cardRepository->updateOrCreateCard($cardArrayData, ['id' => $card['id']]);
            }


            return response()
                ->json([
                    'message' => 'Success',
                    'status' => '200'
                ], 200);
        }
        else {
            return response()
                ->json([
                    'message' => 'You must select at least one card',
                    'status' => '400'
                ], 400);
        }
    }
}

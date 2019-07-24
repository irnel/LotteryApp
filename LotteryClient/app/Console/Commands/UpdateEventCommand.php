<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Card\CardRepositoryInterface;

class UpdateEventCommand extends Command
{
    protected $service;
    protected $userRepository;
    protected $eventRepository;
    protected $cardRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update_event:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status event';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        ApiInterface $service,
        UserRepositoryInterface $userRepository,
        EventRepositoryInterface $eventRepository,
        CardRepositoryInterface $cardRepository)
    {
        $this->service = $service;
        $this->userRepository = $userRepository;
        $this->eventRepository = $eventRepository;
        $this->cardRepository= $cardRepository;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $eventCollection = $this->service->getAllClosedEvents();

        foreach ($eventCollection as $item) {
            $event = $this->eventRepository->find($item->id);

            if ($event != null) {
                $this->eventRepository->update([
                    'winner_card_id' => $item->winner_card_id
                ], $event->id);

                // all user events per event
                $userEvents = $this->eventRepository->getAllUserEventsByEventId($event->id);
                //event winner card
                $winnerCard = $this->cardRepository->find($item->winner_card_id);

                foreach ($userEvents as $userEvent) {
                    if ($winnerCard != null) {
                        $status = (
                            $userEvent->user_id == $winnerCard->user_id &&
                            $userEvent->event_id == $winnerCard->event_id
                        ) ? 'Winner' : 'Loss';
                    } else {
                        $status = 'Loss';
                    }

                    $this->eventRepository->updateUserEvent([
                        'status' => $status
                    ], $userEvent->id);
                }
            }
        }
    }
}



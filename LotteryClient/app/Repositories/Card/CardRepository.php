<?php

namespace App\Repositories\Card;

use App\Models\Card;
use Illuminate\Support\Facades\Auth;

class CardRepository implements CardRepositoryInterface
{
    public function all()
    {
        return Card::all();
    }

    public function create(array $card)
    {
        return Card::create($card);
    }

    public function update(array $card, $id)
    {

    }

    public function delete($id) 
    {

    }

    public function find($id)
    {
        return Card::find($id);
    }    

    public function updateOrCreateCard(array $data, array $params)
    {
        return Card::updateOrCreate($data, $params);
    }
}

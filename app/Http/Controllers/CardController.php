<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Services\CardService;

class CardController extends Controller
{
    public $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    public function index()
    {
        return view('cards.index')->with([
            'card' => $this->cardService->getFromCookieOrCreate(),
        ]);
        // $card = $this->cardService->getFromCookieOrCreate();
        // return view('cards.index')->with([
        //     'products' => $card->products,
        // ]);
    }
}

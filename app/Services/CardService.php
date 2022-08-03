<?php
namespace App\Services;

use App\Models\Card;
use Illuminate\Support\Facades\Cookie;

class CardService
{
    public function getFromCookieOrCreate()
    {
        $cardId = Cookie::get('card'); // Utilizando el facades de Cookie
        // $cardId = cookie()->get('card'); Esto utiliza el herlper de cookie()
        // $cardId = cookie('card'); instancia desde la cookie, funciona pero el codigo no es expresivo
        $card = Card::find($cardId);
        return $card ?? Card::create();
    }
}

?>

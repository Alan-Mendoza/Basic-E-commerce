<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductCardController extends Controller
{

    public function store(Request $request, Product $product)
    {
        // dd("here");
        $card = $this->getFromCookieOrCreate();
        // Card::create(); no podemos crear carrito por que la base se llena asi que lo haremos con cookies

        $quantity = $card->products()
            ->find($product->id)
            ->pivot
            ->quantity ?? 0;

        $card->products()->syncWithoutDetaching([ //attach nos crea a cada rato nuevos carritos sync crea y remueve el carrito anterior creado en la base, syncWithoutDetaching mantiene contador pero no desanexa los que estan
            $product->id => ['quantity' => $quantity + 1],
        ]);

        $cookie = Cookie::make('card', $card->id, 7 * 24 * 60); // Facades de Cookie, las multiplicaciones son en minutos e indican de que esta cookie durara 1 semana
        // $cookie = cookie()->make('card', $card->id, 7 * 24 * 60); Esto utiliza el herlper de cookie()
        // $cookie = cookie('card', $card->id, 7 * 24 * 60); instancia desde la cookie, funciona pero el codigo no es expresivo

        return redirect()->back()->cookie($cookie);
    }

    public function destroy(Product $product, Card $card)
    {
        //
    }

    public function getFromCookieOrCreate()
    {
        $cardId = Cookie::get('card'); // Utilizando el facades de Cookie
        // $cardId = cookie()->get('card'); Esto utiliza el herlper de cookie()
        // $cardId = cookie('card'); instancia desde la cookie, funciona pero el codigo no es expresivo
        $card = Card::find($cardId);
        return $card ?? Card::create();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductCardController extends Controller
{

    public function store(Request $request, Product $product)
    {
        // dd("here");
        $card = Card::create();

        $quantity = $card->products()
            ->find($product->id)
            ->pivot
            ->quantity ?? 0;

        $card->products()->attach([
            $product->id => ['quantity' => $quantity + 1],
        ]);

        return redirect()->back();
    }

    public function destroy(Product $product, Card $card)
    {
        //
    }
}

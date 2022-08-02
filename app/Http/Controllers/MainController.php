<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        // $name = config('app.name');
        // dump($name);
        // dd($name);

        //available() es un scope que se lo encuentra en el modelo Product
        $products = Product::available()->get(); //Como es un query buldier se debe ejecutar la consulta llamando al metodo get()
        return view('welcome')->with([
            'products' => $products,//Product::all(),
        ]);
    }
}

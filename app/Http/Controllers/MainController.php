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
        return view('welcome')->with([
            'products' => Product::all(),
        ]);
    }
}

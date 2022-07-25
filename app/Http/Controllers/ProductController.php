<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        // $products = DB::table('products')->get();
        // dd($products);
            // Modelos
        $products = Product::all();
        // return $products;

        return view('products.index');
    }

    public function create()
    {
        return 'This is the form to create a products';
    }

    public function store()
    {
        //
    }

    public function show($product)
    {
        // $product = DB::table('products')->where('id', $product)->get();
        // $product = DB::table('products')->where('id', $product)->first();
        // $product = DB::table('products')->find($product);
        // dd($product);
            // Modelos
        // $product = Product::find($product);
        $product = Product::findOrFail($product);
        // return $product;

        return view('products.show');
    }

    public function edit($product)
    {
        return "Showing the form to edit the product with id {$product}";
    }

    public function update($product)
    {
        //
    }

    public function destroy($product)
    {
        //
    }

}

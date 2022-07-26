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

        return view('products.index')->with([
            'products' => $products,
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store()
    {
        // $product = Product::create([
        //     'title' => request()->title,
        //     'description' => request()->description,
        //     'price' => request()->price,
        //     'stock' => request()->stock,
        //     'status' => request()->status,
        // ]);
        $product = Product::create(request()->all());
        return $product;
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

        return view('products.show')->with([
            'product' => $product,
            // 'html' => "<h2>Subtitle</h2>",
        ]);
    }

    public function edit($product)
    {
        // Es necesario resolver lo que se va a editar
        return view('products.edit')->with([
            'product' => Product::findOrFail($product),
        ]);
    }

    public function update($product)
    {
        // dd('En Update');
        $product = Product::findOrFail($product);
        $product->update(request()->all());
        return $product;
    }

    public function destroy($product)
    {
        //
    }

}

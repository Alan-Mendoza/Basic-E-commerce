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
        // Validaciones
        $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available, unavailable'],
        ];
        request()->validate($rules);
        // $product = Product::create([
        //     'title' => request()->title,
        //     'description' => request()->description,
        //     'price' => request()->price,
        //     'stock' => request()->stock,
        //     'status' => request()->status,
        // ]);
        // Sesiones
        // if(request()->status == 'available' && request()->stock == 0) {
        //     session()->put('error', 'If available must have stock');
        //     return redirect()->back();
        // }
        // session()->forget('error');
        // Sesion flash
        if(request()->status == 'available' && request()->stock == 0) {
            // session()->flash('error', 'If available must have stock');
            return redirect()
            ->back()
            ->withInput(request()->all())
            ->withErrors('If available must have stock');
        }
        $product = Product::create(request()->all());
        // Mensaje de exito
        // session()->flash('success', "the new product with ID {$product->id} was created");
        // return redirect()->back();
        // return redirect()->action([ProductController::class, 'index']);
        return redirect()->route('products.index')->withSuccess("the new product with ID {$product->id} was created");
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
        $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available, unavailable'],
        ];
        request()->validate($rules);
        // dd('En Update');
        $product = Product::findOrFail($product);
        $product->update(request()->all());
        return redirect()->route('products.index')->withSuccess("the product with ID {$product->id} was edited");
    }

    public function destroy($product)
    {
        $product = Product::findOrFail($product);
        $product->delete();
        return redirect()->route('products.index')->withSuccess("the product with ID {$product->id} was delete");
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->only('index');
        // $this->middleware('auth')->except(['index', 'create']);
        $this->middleware('auth');
    }

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

    public function store(ProductRequest $request)
    {
        // Validaciones
        /* FormRequest
        $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];
        request()->validate($rules);
        Fin FormRequest*/
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
        //LLevamos todo el if a nuestro ProductRequest
        /*if($request->status == 'available' && $request->stock == 0) {
            // session()->flash('error', 'If available must have stock');
            return redirect()
            ->back()
            ->withInput($request->all())
            ->withErrors('If available must have stock');
        }*/
        // Diferencias de requets validated()
        // dd(request()->all(), $request->all(), $request->validated());
        $product = Product::create($request->validated());
        // Mensaje de exito
        // session()->flash('success', "the new product with ID {$product->id} was created");
        // return redirect()->back();
        // return redirect()->action([ProductController::class, 'index']);
        return redirect()->route('products.index')->withSuccess("the new product with ID {$product->id} was created");
    }

    public function show(Product $product)
    {
        // $product = DB::table('products')->where('id', $product)->get();
        // $product = DB::table('products')->where('id', $product)->first();
        // $product = DB::table('products')->find($product);
        // dd($product);
            // Modelos
        // $product = Product::find($product);
        // Para hacer inyecciones implicitas solo debemos comentar la liena de abajo y en los parametros de nuestras funciones $product, colocar el modelo y esto lo hara todo por nosotros
        // Solo funciona en las rutas que tengan parametros como ser show edit update y destroy
        // $product = Product::findOrFail($product);
        // return $product;

        return view('products.show')->with([
            'product' => $product,
            // 'html' => "<h2>Subtitle</h2>",
        ]);
    }

    public function edit(Product $product)
    {
        // Es necesario resolver lo que se va a editar
        return view('products.edit')->with([
            'product' => $product, //Product::findOrFail($product),
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        /* FormRequest
        $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];
        request()->validate($rules);
        Fin FormRequest */
        // dd('En Update');
        // $product = Product::findOrFail($product);
        $product->update($request->validated());
        return redirect()->route('products.index')->withSuccess("the product with ID {$product->id} was edited");
    }

    public function destroy(Product $product)
    {
        // $product = Product::findOrFail($product);
        $product->delete();
        return redirect()->route('products.index')->withSuccess("the product with ID {$product->id} was delete");
    }
}

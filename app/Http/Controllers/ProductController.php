<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Ensure the Product model exists in the App\Models directory
use Illuminate\Support\Facades\Storage; // Import the Storage facade

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->paginate(10);
        return view('Admin.productos.productos', compact('products'));
    }

    public function indexUser()
    {
        $products = Product::orderBy('created_at','desc')->paginate(10);
        return view('User.productos.productos', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'serie' => 'required|string',
            'cantidad' => 'required|integer|min:0',
        ]);

        $product = new Product();
        $product->codigo = $request['codigo'];
        $product->descripcion = $request['descripcion'];
        $product->serie = $request['serie'];
        $product->cantidad = $request['cantidad'];
        $product->save();

        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }
}

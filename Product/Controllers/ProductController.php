<?php

namespace Product\Controllers;

use App\Http\Controllers\Controller;
use Category\Model\Category;
use Provider\Model\Provider;
use Product\Model\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('Product::index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $providers = Provider::all();
        return view('Product::create', compact('categories', 'providers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|numeric|min:1',
            'provider_id' => 'required|exists:providers,id',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Producto creado correctamente.');
    }

    public function show(Product $product)
    {
        return view('Product::show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $providers = Provider::all();
        return view('Product::edit', compact('product', 'categories', 'providers'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'provider_id'=> 'required|exists:providers,id',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Categoría creada exitosamente.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Categoría actualizada exitosamente.');
    }

    public function destroy(Category $category)
    {
        // Verificar si hay productos asociados
        if ($category->products()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'No se puede eliminar la categoría porque tiene productos asociados.');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Categoría eliminada exitosamente.');
    }
}
